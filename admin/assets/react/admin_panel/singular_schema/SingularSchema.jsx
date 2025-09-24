import React, { useState, useEffect } from 'react';
import { Pagination } from 'semantic-ui-react'
import {Link} from 'react-router-dom';
import MainSpinner from '../common/main-spinner/MainSpinner';
import { schemaTypes } from '../../shared/schemaTypes';
import './SingularSchema.css';


const SingularSchema = () => {
  
  const {__} = wp.i18n; 

  const [showDeleteSchemaModal, setShowDeleteSchemaModal]     = useState(false);
  const [schemaLoop, setSchemaLoop]                           = useState([]);
  const [postsFound, setPostsFound]                           = useState(0);
  const [mainSpinner, setMainSpinner]                         = useState(false);
  const [currentSelectPost,   setCurrentSelectPost]           = useState(null);
  const [currentSelectPostIndex, setCurrentSelectPostIndex]   = useState(null);

  const changePostStatusHandler = (action, post_id, status) => {

    const body_json          = {};

    body_json.post_id        = post_id;
    body_json._current_status = status;
    body_json.action         = action;
    
    let url = smpg_local.rest_url + 'change-post-status';
      
    fetch(url,{
      method: "post",
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-WP-Nonce': smpg_local.nonce,
      },
      body: JSON.stringify(body_json)
    })
    .then(res => res.json())
    .then(
      (result) => {
        
      },        
      (error) => {
        
      }
    );

  }

  const getSchemaLoop = (page) => {
    setMainSpinner(true);
    let url = smpg_local.rest_url + "get-schema-loop" + (smpg_local.rest_url.includes("?") ? "&" : "?") + "post_type=smpg_singular_schema&page=" + page;
      
      fetch(url, {
        headers: {                    
          'X-WP-Nonce': smpg_local.nonce,
        }
      })
      .then(res => res.json())
      .then(
        (result) => {    
          setMainSpinner(false);     
          setSchemaLoop(result.posts_data);
          setPostsFound(result.posts_found);
        },        
        (error) => {         
        }
      ); 

  }

  const cancelDeletion = (e) => {
    e.preventDefault();
    setCurrentSelectPost(null);
    setCurrentSelectPostIndex(null);
    setShowDeleteSchemaModal(false);
  }
  const confirmDeletion = (e) => {
    e.preventDefault();    

    if(currentSelectPost){
      changePostStatusHandler('delete', currentSelectPost, true);
    }

    if(currentSelectPostIndex >=0 ){      
      let clonedata = [...schemaLoop];    
      clonedata.splice(currentSelectPostIndex, 1);      
      setSchemaLoop(clonedata);
      if(clonedata.length == 0){
        setPostsFound(0);
      }
    }
    
    setShowDeleteSchemaModal(false);
  }
  const handleShowDeleteSchemaModal = (e) => {
    e.preventDefault();
    let post_id  = e.currentTarget.dataset.id;
    let index    = e.currentTarget.dataset.index;
    setCurrentSelectPost(post_id);
    setCurrentSelectPostIndex(index);
    setShowDeleteSchemaModal(true);
  }
    
  const handleStatusChange = (e) => {

    let post_id  = e.currentTarget.dataset.id;
    let index    = e.currentTarget.dataset.index;    
    let status   = e.target.checked;

    let clonedata = [...schemaLoop];    
    
    clonedata[index].post_meta._current_status = status;
    setSchemaLoop(clonedata);
    changePostStatusHandler('change', post_id, status);
         
  }

  const handlePageChange = (e, data) => {

    getSchemaLoop(data.activePage);
      
  }

  const extractSchemaTypeText = (prop) => {
    
    let schematext = '';
    
    schemaTypes.map( (item, i) => {      
          if(item.value == prop){
            schematext = item.text;
          }
    });

    return schematext;

  }
  
  useEffect(() => {      
    getSchemaLoop(1);
  }, [])  

  return (
    <>           
        <div className="smpg-single-schema">          
        {mainSpinner ? <MainSpinner /> : ''}
          {/* Invisible html starts here */}          
          {/* Delete pop up start here */}
          {showDeleteSchemaModal ? 
            
            <div className="smpg-modal-popup">
            <div className="smpg-modal-popup-content-small">                            
            <div className="smpg-modal-header">{__('Delete Schema', 'schema-package') }</div>
            <div className="smpg-modal-content">{__('Are you sure you want to delete schema ?', 'schema-package') }</div>
            <div className="smpg-modal-footer">
            <a onClick={cancelDeletion} className="ui negative button">{__('No', 'schema-package') }</a>
            <a onClick={confirmDeletion} className="ui icon positive right labeled button">{__('Yes', 'schema-package') } <i aria-hidden="true" className="checkmark icon"></i></a>
            </div>  
            </div>
          </div>
           : ''
          }
          {/* Delete pop up ends here */}
          {/* Invisible html ends here */}

          <div className="smpg-single-schema-header">
          <Link to={`?page=schema_package&path=singular_schema_edit`} className="smpg-add-schema-btn ui icon button primary"><i aria-hidden="true" className="add icon"></i> {__('Add Schema', 'schema-package') }</Link>

          </div>
          <div className="smpg-single-schema-table">
            {
              postsFound > 0 ?
              <table className="ui single line table">
          <thead >
            <tr>
              <th>{__('Schema Type', 'schema-package') }</th>
              <th>{__('Modify Date', 'schema-package') }</th>      
              <th>{__('Status', 'schema-package') }</th>
              <th>{__('Action', 'schema-package') }</th>
            </tr>
          </thead>  
          <tbody >

            {schemaLoop ? 
            
            schemaLoop.map( (item, i) => {
              return(
                item.post_meta._schema_type ?  
                <tr key={i}>
                <td >{extractSchemaTypeText(item.post_meta._schema_type)}</td>      
                <td >{item.post.post_modified}</td>      
                <td >
                <div className="ui fitted toggle checkbox">
                  <input data-index={i} data-id={item.post.post_id} onChange={handleStatusChange} checked={item.post_meta._current_status ? true : false} type="checkbox" />
                  <label></label>
                </div>
                </td>
                <td>
                <div className="smpg-action">
                  <Link to={`?page=schema_package&path=singular_schema_edit&post_id=${item.post.post_id}`}><i aria-hidden="true" className="edit icon"></i></Link>
                  <a data-index={i} data-id={item.post.post_id} onClick={handleShowDeleteSchemaModal}><i aria-hidden="true" className="trash icon"></i></a>
                </div>        
                </td>
              </tr> : ''
            )   
            }) : null}
            
          </tbody>
        </table>          
              : <div className="one column row">
                  <div className="column">
                    <div className="ui info message">
                    {__('You have not configured any schema types. Please add one or more schemas to continue.', 'schema-package') }
                    </div>
                  </div>
              </div>
            }
          </div>
          
          <div className="smpg-single-schema-footer">
            {
              postsFound > 10 ? 
                <Pagination
                  defaultActivePage={1}
                  totalPages={Math.ceil(postsFound / 10)}                  
                  onPageChange={handlePageChange}
                />
              : ''
            }          
          </div>

        </div>    
    </>
  )
}
export default SingularSchema;