import React, {useState, useReducer, useEffect} from 'react';
import queryString from 'query-string'
import { Link} from 'react-router-dom';
import { Dropdown, TableCell } from 'semantic-ui-react'
import { Button } from 'semantic-ui-react'
import {useHistory} from 'react-router-dom';
import MainSpinner from './common/main-spinner/MainSpinner';
import { schemaTypes } from '../shared/carouselSchemaTypes';
import Accordion from '../shared/Accordion/Accordion'; 


const CarouselSchemaEdit = () => {

  const {__}    = wp.i18n;        
  const page    = queryString.parse(window.location.search);  
  const history = useHistory();   

  const [mainSpinner, setMainSpinner]           = useState(false);
  const [isLoaded, setIsLoaded]                 = useState(true);        
  const [automationList, setAutomationList]     = useState([]);

  const [postData, setPostData] = useReducer(
    (state, newState) => ({...state, ...newState}),
    {
      ID          : null,
      post_title  : 'Untitle',
      post_status : 'publish',
      post_type   : 'smpg_carousel_schema'
    }                      
  );

  const [postMeta, setPostMeta] = useReducer(
    (state, newState) => ({...state, ...newState}),
    {
      current_status          : true,
      schema_type             : 'course',                                       
      automation_with         : [],
      taxonomies              : []
    }            
  );
  
  const handleFormChange = e => {

    let { name, value, type, id } = e.target;

    if( type === "checkbox" ){
      value = e.target.checked;
    }
    
    let clonedata = {...postMeta};   
    clonedata.taxonomies[id].status = value
    console.log(clonedata);
    setPostMeta(clonedata);
            
  }  

  const getSchemaData = ( post_id = null ) => {
    
    setMainSpinner(true);

    let url = smpg_local.rest_url + "smpg-route/get-carousel-schema-data?post_id="+post_id;
      
      fetch(url, {
        headers: {                    
          'X-WP-Nonce': smpg_local.nonce,
        }
      })
      .then(res => res.json())
      .then(
        (result) => {              
          setMainSpinner(false);     
          setPostData(result.post_data);
          setPostMeta(result.post_meta);                                      
        },        
        (error) => {         
        }
      ); 

  }

  const handleSaveFormData = () => {

      const body_json       = {};                                      

      body_json.post_data = postData;
      body_json.post_meta = postMeta;

      setIsLoaded(false);

      let url = smpg_local.rest_url + 'smpg-route/save-carousel-schema-data';
        
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

          setIsLoaded(true);  
          
          setPostData({ID: result.post_id});          

          let query = '?page='+page.page+'&path='+page.path+'&post_id='+result.post_id;
          let search = location.pathname + query;
              history.push(search)
          
        },        
        (error) => {
          
        }
      );   


  }
  const handleGetAutomation = (schema_type) => {

    let url = smpg_local.rest_url + "smpg-route/get-carousel-automation-with?schema_type="+schema_type;
        
    fetch(url, {
      headers: {                    
        'X-WP-Nonce': smpg_local.nonce,
      }
    })
    .then(res => res.json())
    .then(
      (result) => {              
          if(result.status == 'success'){
            setAutomationList(result.data);
          }
      },        
      (error) => {         
      }
    ); 

  }
  const handleSchemaTypeChange = (e, data) => {    
    setPostMeta({schema_type: data.value});     
  }
  const handlePlacementChange = (e, data) => {
    
      let data_id = data.data_id;      
      let copydata = {...postMeta};
      copydata.taxonomies[data_id].value = data.value;
      setPostMeta(copydata);    

  }
  const handlePlacementSearch = (id, type, search, name) => {
        
      let url = smpg_local.rest_url + "smpg-route/carousel-placement-search?type="+type+"&search="+search;
        
      fetch(url, {
        headers: {                    
          'X-WP-Nonce': smpg_local.nonce,
        }
      })
      .then(res => res.json())
      .then(
        (result) => {
                                         
          if ( result ) {
                        
                let clonedata = {...postMeta};
                let newclone = [...new Set([...clonedata.taxonomies[id].options, ...result])]
                let newData = Array.from(new Set(newclone.map(JSON.stringify))).map(JSON.parse);    
                clonedata.taxonomies[id].options = newData;            
                setPostMeta(clonedata);                        
            
          }
                    
        },        
        (error) => {         
        }
      );

  }
  let timer;
  const handlePlacementSearchChange = (e, data) => {
      
      let id     = data.data_id;
      let type   = data.data_type;
      let name   = data.name;
      let search = data.searchQuery;

      if(type && search){
        clearTimeout(timer);
        timer = setTimeout(()=> handlePlacementSearch(id, type, search, name), 1000)            
      }
      
  }

  const handleAutomationChange = (e) => {
    
    let { name } = e.target;

    let copydata = {...postMeta};

    let index = copydata.automation_with.indexOf(name);

    if(index !== -1){  
      copydata.automation_with.splice(index, 1); 
    }else{
      copydata.automation_with.push(name);
    }
    setPostMeta(copydata);
    
  }

  useEffect(() => {
    let post_id = '';
    if( typeof(page.post_id) != 'undefined' ){
      post_id = page.post_id;
    }
    getSchemaData(post_id);
    
  }, []);

  useEffect(() => {
    if(postMeta.schema_type != ''){
      handleGetAutomation(postMeta.schema_type);    
    }    
  }, [postMeta.schema_type]);

  
  return(
    <div className="smpg-edit-page">

    
      {mainSpinner ? <MainSpinner /> : ''}
      <div className="smpg-edit-close">
        <Link to={`?page=schema_package&path=carousel_schema`}><i aria-hidden="true" className="close icon"></i></Link>
      </div>

      <div className="smpg-main-section">
  
      <div className="smpg-left-section">
      <div className="smpg-edit-page-content">
        
      <Accordion title="Carousel Type" isExpand={true}>
      <Dropdown
              placeholder={__('Select Schema', 'schema-package') }
              fluid
              search
              selection
              value = {postMeta.schema_type}
              options={schemaTypes}
              onChange={handleSchemaTypeChange}
          />
      </Accordion>               
    {postMeta.taxonomies ?
    <Accordion title="Targeting" isExpand={true}>
    <div className="">
                <h4>{__('Taxonomies List', 'schema-package') }</h4>

                <table className="smpg-placement-table">
                  <tbody>                    
                  {
                    postMeta.taxonomies.map((item, i) => {
                      return(
                        <tr key={i}>
                        <td><label>{item.label}</label></td>                        
                        <td>
                          <div className="ui fitted toggle checkbox">
                          <input id={i} type="checkbox" name={item.taxonomy} checked={item.status} onChange={handleFormChange} />
                          <label></label>
                          </div>                         
                        </td>
                        

                        <td>                        
                          <Dropdown
                            name={item.taxonomy}
                            data_type={item.taxonomy}
                            data_id={i}
                            placeholder={`Search For ${item.label}`}
                            fluid
                            multiple
                            search
                            selection
                            value={item.value}
                            onChange={handlePlacementChange}
                            onSearchChange={handlePlacementSearchChange}
                            options={item.options}
                          />                                          
                        </td>
                        <td className='smpg-placement-or'>{(i+1) < postMeta.taxonomies.length ? <span>OR</span> : ''}</td>
                        </tr>
                      )
                    })
                  }                   
                  </tbody>
                </table>
              </div>                  
              
    </Accordion>
    : null}                   
      </div>
      </div>
      <div className="smpg-right-section">  

         {postMeta.schema_type ?                
        <Accordion title="Automation With" isExpand={true}>      
        <h3></h3>
        {
        automationList.length > 0 ? 
        <table className="form-table">
        <tbody>
          {
            automationList.map((item, i) => {
              return(
                <tr key={i}>
                <th>{item.name}</th>
                <td><input onChange={handleAutomationChange} name={item.id} checked={ postMeta.automation_with.includes(item.id) ? true : false } type="checkbox"/></td> 
                </tr>
              )
          })
          }
        </tbody>  
        </table> 
          : <div>{__('None of the plugins are active where schema markup can be automated. Find the automation list here', 'schema-package') }</div>
        }                   
       
      </Accordion> 
         
         : ''}           
        
        <div className="smpg-save-schema-btn">
        {isLoaded ? <Button primary onClick={handleSaveFormData}>{__('Save', 'schema-package')}</Button> : <Button loading primary>Loading</Button>}                  
        </div>            
      </div>
      </div>
    </div>
  );

}
export default CarouselSchemaEdit;