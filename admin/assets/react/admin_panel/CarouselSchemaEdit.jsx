import React, {useState, useReducer, useEffect} from 'react';
import queryString from 'query-string'
import { Link} from 'react-router-dom';
import { Dropdown, TableCell } from 'semantic-ui-react'
import { Button } from 'semantic-ui-react'
import {useHistory} from 'react-router-dom';
import DottedSpinner from './common/dotted-spinner/DottedSpinner';
import MainSpinner from './common/main-spinner/MainSpinner';
import { schemaTypes } from '../shared/carouselSchemaTypes';
import Accordion from '../shared/Accordion/Accordion'; 


const CarouselSchemaEdit = () => {

  const {__}    = wp.i18n;        
  const page    = queryString.parse(window.location.search);  
  const history = useHistory();   

  const [mainSpinner, setMainSpinner]           = useState(false);
  const [isLoaded, setIsLoaded]                 = useState(true);      
  const [dottedSpinner, setDottedSpinner]       = useState(false);     
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
      schema_type             : 'course',            
      current_status          : true,                        
      automation_with         : [],
      taxonomies              : []
    }            
  );
  
  const handleFormChange = e => {

    let { name, value, type } = e.target;

    if(type === "checkbox"){
      value = e.target.checked;
    }

    setPostMeta({[name]: value});
            
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
    
      let data_type = data.data_type;
      let copydata = {...postMeta};

        if((data.name).includes('enabled_on')){
          copydata.enabled_on[data_type] = data.value;
        }

        if((data.name).includes('disabled_on')){
          copydata.disabled_on[data_type] = data.value;
        }
        
        setPostMeta(copydata);    

  }
  const handlePlacementSearch = (type, search, name) => {
        
      let url = smpg_local.rest_url + "smpg-route/carousel-placement-search?type="+type+"&search="+search;
        
      fetch(url, {
        headers: {                    
          'X-WP-Nonce': smpg_local.nonce,
        }
      })
      .then(res => res.json())
      .then(
        (result) => {
                              
          if(result){
            
            if(name.includes('enable')){

                let clonedata = {...enabledOnOption};    
                let newclone = [...new Set([...clonedata[type],...result])]
                let newData = Array.from(new Set(newclone.map(JSON.stringify))).map(JSON.parse);    
                clonedata[type] = newData;            
                //setEnabledOnOption(clonedata);

            }            
            
          }
                    
        },        
        (error) => {         
        }
      );

  }
  let timer;
  const handlePlacementSearchChange = (e, data) => {
                    
      let type   = data.data_type;
      let name   = data.name;
      let search = data.searchQuery;

      if(type && search){
        clearTimeout(timer);
        timer = setTimeout(()=> handlePlacementSearch(type, search, name), 1000)            
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

  // useEffect(() => {
  //   console.log(taxonomies);
  // }, [taxonomies]);

  

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
                          <input type="checkbox" name={item.taxonomy} checked={item.status} onChange={handleFormChange} />
                          <label></label>
                          </div>                         
                        </td>
                        

                        <td>                        
                          <Dropdown
                            name={item.taxonomy}
                            data_type={item.taxonomy}
                            placeholder={`Search For ${item.label}`}
                            fluid
                            multiple
                            search
                            selection
                            value={item.value}
                            // onChange={handlePlacementChange}
                            // onSearchChange={handlePlacementSearchChange}
                            options={item.options}
                          />                                          
                        </td>
                        </tr>
                      )
                    })
                  }

                   {/* <tr>                   
                   
                   <td>
                     {enabledOnOption.post_type ? 
                     <Dropdown
                     name="enabled_on_post_type"
                     data_type="post_type"
                     placeholder={__('Search For Post Type', 'schema-package') }
                     fluid
                     multiple
                     search
                     selection
                     value={postMeta.enabled_on.post_type}
                     onChange={handlePlacementChange}
                     onSearchChange={handlePlacementSearchChange}
                     options={enabledOnOption.post_type}
                   />
                   : ''
                     }                   
                   </td>
                   </tr>                                        */}
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