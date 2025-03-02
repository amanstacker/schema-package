import React, {useState, useReducer, useEffect} from 'react';
import queryString from 'query-string'
import { Link } from 'react-router-dom';
import { Dropdown, Grid, Icon, Divider } from 'semantic-ui-react'
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
      _current_status          : true,
      _schema_type             : 'course',                                       
      _automation_with         : [],
      _taxonomies              : []
    }            
  );
  
  const handleFormChange = e => {

    let { name, value, type, id } = e.target;

    if( type === "checkbox" ){
      value = e.target.checked;
    }
    
    let clonedata = {...postMeta};   
    clonedata._taxonomies[id].status = value
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
    setPostMeta({_schema_type: data.value});     
  }
  const handlePlacementChange = (e, data) => {
    
      let data_id = data.data_id;      
      let copydata = {...postMeta};
      copydata._taxonomies[data_id].value = data.value;
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
                let newclone = [...new Set([...clonedata._taxonomies[id].options, ...result])]
                let newData = Array.from(new Set(newclone.map(JSON.stringify))).map(JSON.parse);    
                clonedata._taxonomies[id].options = newData;            
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

    let index = copydata._automation_with.indexOf(name);

    if(index !== -1){  
      copydata._automation_with.splice(index, 1); 
    }else{
      copydata._automation_with.push(name);
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
    if(postMeta._schema_type != ''){
      handleGetAutomation(postMeta._schema_type);    
    }    
  }, [postMeta._schema_type]);

  
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
              value = {postMeta._schema_type}
              options={schemaTypes}
              onChange={handleSchemaTypeChange}
          />
      </Accordion>               
    {postMeta._taxonomies ?
    <Accordion title="Targeting" isExpand={true}>
    <div className="">
                <h4>{__('Target On', 'schema-package') }</h4>

                <table className="smpg-placement-table">
                  <tbody>                    
                  {
                    postMeta._taxonomies.map((item, i) => {
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
                        <td className='smpg-placement-or'>{(i+1) < postMeta._taxonomies.length ? <span>OR</span> : ''}</td>
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

         {postMeta._schema_type ?                
        
        <Accordion title="Automation" isExpand={true}>      

         {automationList.length > 0 ?  
         
         <Grid>
            <Grid.Row>
              <Grid.Column>
                <Form>
                  {automationList.map((item) => (
                      <Form.Field key={item.key}>
                        <Checkbox
                          label={item.text}                          
                          checked={!!postMeta._automation_with.includes(item.key)}
                          onChange={() => handleAutomationChange(item.key)}                          
                        />
                      </Form.Field>
                  ))}                                      
                </Form>
              </Grid.Column>
              </Grid.Row>
          </Grid>

         : <div>
            <p>
            {__('None of the supported Schema Package Automation plugins are currently active, preventing automated schema markup.', 'schema-package') }</p>
            <a target='_blank' rel="noopener noreferrer" href='https://wordpress.org/plugins/schema-package/'><Icon name="list alternate outline" />{__('Automation List', 'schema-package')}</a>
            <Divider />
            <p>{__('Can\'t find your plugin in the list? Request automation from us!', 'schema-package') }</p>            
            <a target='_blank' rel="noopener noreferrer" href='https://schemapackage.com/contactus/'><Icon name="paper plane" />{__('Feature Request', 'schema-package')}</a>
          </div>}                 
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