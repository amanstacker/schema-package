import React, {useState, useReducer, useEffect} from 'react';
import queryString from 'query-string'
import { Link} from 'react-router-dom';
import { Dropdown, Checkbox, Grid, Form, Button, Divider, Icon, Label, TextArea, Message } from 'semantic-ui-react'
import {useHistory} from 'react-router-dom';
import MainSpinner from './common/main-spinner/MainSpinner';
import { schemaTypes } from '../shared/schemaTypes';
import Accordion from '../shared/Accordion/Accordion'; 
import PropertySelector from './mapping/PropertySelector';
import SchemaMapping from './mapping/SchemaMapping';
import CustomSchema from './common/CustomSchema';

const SingularSchemaEdit = () => {

  const {__}    = wp.i18n;        
  const page    = queryString.parse(window.location.search);  
  const history = useHistory();   

  const [mainSpinner, setMainSpinner]           = useState(false);
  const [isLoaded, setIsLoaded]                 = useState(true);        
  const [enabledOnOption, setEnabledOnOption]   = useState({});
  const [disabledOnOption, setDisabledOnOption] = useState({});
  const [automationList, setAutomationList]     = useState([]);  
  const [schemaProperties, setSchemaProperties] = useState([]);
  const [isSchemaDataLoaded, setIsSchemaDataLoaded] = useState(false);



  const [postData, setPostData] = useReducer(
    (state, newState) => ({...state, ...newState}),
    {
      ID          : null,
      post_title  : 'Untitle',
      post_status : 'publish',
      post_type   : 'smpg_singular_schema'
    }                      
  );

  const postMetaReducer = (state, newState) => {
    if (typeof newState === "function") {
      return { ...state, ...newState(state) }; // Handles function-based updates
    }
    return { ...state, ...newState };
  };
  
  const [postMeta, setPostMeta] = useReducer(postMetaReducer, {
    _schema_type: "article",
    _mapped_properties_key: [],
    _mapped_properties_value: {},
    _add_comments: false,
    _add_speakable: false,
    _current_status: true,
    _enabled_on_post_type: false,
    _enabled_on_post: false,
    _enabled_on_page: false,
    _disabled_on_post_type: false,
    _disabled_on_post: false,
    _disabled_on_page: false,
    _enabled_on: { post_type: [], post: [], page: [] },
    _disabled_on: { post_type: [], post: [], page: [] },
    _automation_with: [],
    _custom_schema: '',
  });
  
  const handlePropertySelection = (key) => {
    setPostMeta((prevState) => ({
      ...prevState,
      _mapped_properties_key: prevState._mapped_properties_key.includes(key)
        ? prevState._mapped_properties_key.filter((item) => item !== key)
        : [...prevState._mapped_properties_key, key],
    }));
  };
  
  const handleCustomSchema = ( value ) => {
        
    setPostMeta({'_custom_schema': value});
            
  }

  const handleFormChange = e => {

    let { name, value, type } = e.target;

    if(type === "checkbox"){
      value = e.target.checked;
    }

    setPostMeta({[name]: value});
            
  }  




  const getSchemaData = async (post_id = null) => {
    try {
        setMainSpinner(true);

        let url = smpg_local.rest_url + "smpg-route/get-schema-data?post_id=" + post_id;
        
        const response = await fetch(url, {
            headers: {                    
                'X-WP-Nonce': smpg_local.nonce,
            }
        });

        const result = await response.json();

        setMainSpinner(false);
        setPostData(result.post_data);
        setPostMeta(result.post_meta);
        setEnabledOnOption(result?._placement_enabled_option);
        setDisabledOnOption(result?._placement_disabled_option);
        setIsSchemaDataLoaded(true);
        
    } catch (error) {
        console.error("Error fetching schema data:", error);
        setMainSpinner(false);
    }
};


  const handleSaveFormData = () => {

      const body_json       = {};                                      

      body_json.post_data = postData;
      body_json.post_meta = postMeta;

      setIsLoaded(false);

      let url = smpg_local.rest_url + 'smpg-route/save-schema-data';
        
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

  const handleGetSchemaProperties = (schema_type) => {

    let url = smpg_local.rest_url + "smpg-route/get-schema-properties?schema_type="+schema_type;
        
    fetch(url, {
      headers: {                    
        'X-WP-Nonce': smpg_local.nonce,
      }
    })
    .then(res => res.json())
    .then(
      (result) => {              
          if(result.status == 'success'){
            setSchemaProperties(result.data);            
          }
      },        
      (error) => {         
      }
    ); 

  }
  const handleGetAutomation = (schema_type) => {

    let url = smpg_local.rest_url + "smpg-route/get-automation-with?schema_type="+schema_type;
        
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
  
  const handleMappedPropertiesValue = (mappedValue) => {
    setPostMeta(prevState => {
      // Filter mappedValue to only include keys present in _mapped_properties_key
      const filteredMappedValue = Object.keys(mappedValue)
        .filter(key => prevState._mapped_properties_key.includes(key))
        .reduce((obj, key) => {
          obj[key] = mappedValue[key];
          return obj;
        }, {});
  
      return {
        ...prevState,
        _mapped_properties_value: filteredMappedValue
      };
    });
  };
  
  const handleSchemaTypeChange = (e, data) => {

      setPostMeta(prevState => ({
        ...prevState,
        _schema_type: data.value,
        _mapped_properties_key: [],
        _mapped_properties_value:{}
      }));  

  }

  const handlePlacementChange = (e, data) => {
    
    let data_type = data.data_type;
    
    setPostMeta(prevState => ({
        ...prevState,
        _enabled_on: {
            ...prevState._enabled_on,
            ...(data.name.includes('_enabled_on') && { [data_type]: data.value })
        },
        _disabled_on: {
            ...prevState._disabled_on,
            ...(data.name.includes('_disabled_on') && { [data_type]: data.value })
        }
    }));
};

  const handlePlacementSearch = (type, search, name) => {
        
      let url = smpg_local.rest_url + "smpg-route/placement-search?type="+type+"&search="+search;
        
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
                setEnabledOnOption(clonedata);

            }

            if(name.includes('disable')){

                let clonedata = {...disabledOnOption};    
                let newclone = [...new Set([...clonedata[type],...result])]
                let newData = Array.from(new Set(newclone.map(JSON.stringify))).map(JSON.parse);    
                clonedata[type] = newData;            
                setDisabledOnOption(clonedata);

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

  const handleAutomationChange = (key) => {
    setPostMeta((prevState) => ({
      ...prevState,
      _automation_with: prevState._automation_with.includes(key)
        ? prevState._automation_with.filter((item) => item !== key)
        : [...prevState._automation_with, key],
    }));
  };

  useEffect(() => {
    if (typeof page !== "undefined" && typeof page.post_id !== "undefined") {
      getSchemaData(page.post_id);
  } else {
      getSchemaData('');
  }
    
  }, []);

  useEffect(() => {
    if (isSchemaDataLoaded && postMeta?._schema_type) {
        handleGetAutomation(postMeta._schema_type);
        handleGetSchemaProperties(postMeta._schema_type);
    }
}, [isSchemaDataLoaded, postMeta?._schema_type]);

  return(
    <div className="smpg-edit-page">

    
      {mainSpinner ? <MainSpinner /> : ''}
      <div className="smpg-edit-close">
      <Link to={`?page=schema_package`}><i aria-hidden="true" className="close icon"></i></Link>
      </div>

      <div className="smpg-main-section">

      <div className="smpg-left-section">
      <div className="smpg-edit-page-content">
        
      <Accordion title="Schema Type" isExpand={true}>
      <Dropdown
              placeholder={__('Select Schema', 'schema-package') }
              fluid
              search
              selection
              value = {postMeta._schema_type}
              options={schemaTypes}
              onChange={handleSchemaTypeChange}
          />
       
       <div>
            
      {/* Schema Mapping Section (only show if any property is selected) */}
      {postMeta._mapped_properties_key.length > 0 && <SchemaMapping schemaProperties={schemaProperties} mappedPropertiesKey={postMeta._mapped_properties_key} mappedPropertiesValue={postMeta._mapped_properties_value} handleMappedPropertiesValue={handleMappedPropertiesValue} />}
    </div>

    { postMeta._schema_type == 'customschema' ? 
      <CustomSchema setCustomSchema={handleCustomSchema} customSchemaValue={postMeta._custom_schema} /> :
    '' }
    
      </Accordion>               

    <Accordion title="Targeting" isExpand={true}>
    <div>
                <Divider horizontal >{__("Target On", "schema-package")}</Divider>
                <table className="smpg-placement-table">
                  <tbody>
                   <tr>
                   <td><Label>{__('Post Types', 'schema-package') }</Label></td>
                   <td>
                   <div className="ui fitted toggle checkbox">
                  <input type="checkbox" name="_enabled_on_post_type" checked={postMeta._enabled_on_post_type} onChange={handleFormChange} />
                  <label></label>
                </div>                         
                   </td>
                   <td>
                     {enabledOnOption?.post_type ? 
                     <Dropdown
                      name="_enabled_on_post_type"
                      data_type="post_type"
                      placeholder={__('Search For Post Type', 'schema-package') }
                      fluid
                      multiple
                      search
                      selection                      
                      value={postMeta._enabled_on?.post_type || []}
                      onChange={handlePlacementChange}
                      onSearchChange={handlePlacementSearchChange}
                      options={enabledOnOption?.post_type || []}
                   />
                   : ''
                     }
                   
                   </td>
                   <td className='smpg-placement-or'><span>{__('OR', 'schema-package') }</span></td>
                   </tr> 
                   <tr> 
                   <td><Label>{__('Posts', 'schema-package') }</Label></td>
                   <td>
                   <div className="ui fitted toggle checkbox">
                  <input type="checkbox" name="_enabled_on_post" checked={postMeta._enabled_on_post} onChange={handleFormChange} />
                  <label></label>
                  </div>
                   </td>
                   <td>
                     {
                       enabledOnOption?.post ? 
                        <Dropdown
                        data_type="post"
                        name="_enabled_on_post"
                        placeholder={__('Search For Post', 'schema-package') }
                        fluid
                        multiple
                        search
                        selection                        
                        value={postMeta._enabled_on?.post || []}
                        onChange={handlePlacementChange}
                        onSearchChange={handlePlacementSearchChange}
                        options={enabledOnOption?.post || []}
                      />
                  : ''
                  }                    
                  </td>
                    <td className='smpg-placement-or'><span>{__('OR', 'schema-package') }</span></td>
                   </tr> 
                   <tr> 
                   <td><Label>{__('Pages', 'schema-package') }</Label></td>
                   <td>
                   <div className="ui fitted toggle checkbox">
                  <input type="checkbox" name="_enabled_on_page" checked={postMeta._enabled_on_page} onChange={handleFormChange} />
                  <label></label>
                  </div>
                   </td>
                   <td>
                     {enabledOnOption?.page ? 
                     <Dropdown
                     data_type="page"
                     name="_enabled_on_page"
                     placeholder='Search For Page'
                     fluid
                     multiple
                     search
                     selection                     
                     value={postMeta._enabled_on?.page || []}
                     onChange={handlePlacementChange}
                     onSearchChange={handlePlacementSearchChange}
                     options={enabledOnOption?.page || []}
                   /> : ''
                     }
                  </td>
                   </tr>                                       
                  </tbody>
                </table>
              </div>                  
              <div className="">
              <Divider horizontal style={{marginTop:"40px"}}>{__("Target Off", "schema-package")}</Divider>
                <table className="smpg-placement-table">
                  <tbody>
                   <tr>
                   <td><Label>{__('Post Types', 'schema-package') }</Label></td>
                   <td>
                   <div className="ui fitted toggle checkbox">
                  <input type="checkbox" name="_disabled_on_post_type" checked={postMeta._disabled_on_post_type} onChange={handleFormChange} />
                  <label></label>
                  </div>                         
                   </td>
                   <td>
                   {disabledOnOption?.post_type ?
                   <Dropdown
                   data_type="post_type"
                   name="_disabled_on_post_type"
                   placeholder='Search For Post Type'
                   fluid
                   multiple
                   search
                   selection                   
                   value={postMeta._disabled_on?.post_type || []}
                   onChange={handlePlacementChange}
                   onSearchChange={handlePlacementSearchChange}
                   options={disabledOnOption?.post_type || []}
                 />
                 : ''
                   }
                   </td>
                   <td className='smpg-placement-or'><span>{__('OR', 'schema-package') }</span></td>
                   </tr> 
                   <tr> 
                   <td><Label>{__('Posts', 'schema-package') }</Label></td>
                   <td>
                   <div className="ui fitted toggle checkbox">
                  <input type="checkbox" name="_disabled_on_post" checked={postMeta._disabled_on_post} onChange={handleFormChange} />
                  <label></label>
                  </div>
                   </td>
                   <td>
                    {disabledOnOption?.post ?
                    <Dropdown
                    data_type="post"
                    name="_disabled_on_post"
                    placeholder={__('Search For Post', 'schema-package') }
                    fluid
                    multiple
                    search
                    selection                    
                    value={postMeta._disabled_on?.post || []}
                    onChange={handlePlacementChange}
                    onSearchChange={handlePlacementSearchChange}
                    options={disabledOnOption?.post || []}
                  />
                  : ''
                    }
                  </td>
                  <td className='smpg-placement-or'><span>{__('OR', 'schema-package') }</span></td>
                   </tr> 
                   <tr> 
                   <td><Label>{__('Pages', 'schema-package') }</Label></td>
                   <td>
                   <div className="ui fitted toggle checkbox">
                  <input type="checkbox" name="_disabled_on_page" checked={postMeta._disabled_on_page} onChange={handleFormChange} />
                  <label></label>
                  </div>
                   </td>
                   <td>
                    {disabledOnOption?.page ?
                    <Dropdown
                    data_type="page"
                    name="_disabled_on_page"
                    placeholder={__('Search For Page', 'schema-package') }
                    fluid
                    multiple
                    search
                    selection                    
                    value={postMeta._disabled_on?.page || []}
                    onChange={handlePlacementChange}
                    onSearchChange={handlePlacementSearchChange}
                    options={disabledOnOption?.page || []}
                  />
                  : ''
                    }
                  </td>
                   </tr>                                       
                  </tbody>
                </table>
              </div>  
    </Accordion>               
      </div>
      </div>
      
      <div className="smpg-right-section">  
      { postMeta._schema_type != 'customschema' ?
        <Accordion title="Schema Properties" isExpand={true}>        
          <PropertySelector schemaProperties={schemaProperties} mappedPropertiesKey={postMeta._mapped_properties_key} onSelectProperty={handlePropertySelection} />
        </Accordion>
      : '' }        
      
       {postMeta._schema_type == 'article' ?
        <Accordion title="Additional Schema" isExpand={true}>
          <Grid>
            <Grid.Row>
              <Grid.Column>
                <Form>
                  <Form.Field key='_add_comments'>
                    <Checkbox                     
                      label={__('Comments', 'schema-package') }
                      name='_add_comments'
                      id='_add_comments' 
                      checked={!!postMeta._add_comments}
                      onChange={handleFormChange}
                    />                                      
                    </Form.Field>
                    <Form.Field key='_add_speakable'>
                      <Checkbox                     
                        label={__('Speakable', 'schema-package') }
                        name='_add_speakable'
                        id='_add_speakable' 
                        checked={!!postMeta._add_speakable}
                        onChange={handleFormChange}
                      />                              
                    </Form.Field>
                </Form>
              </Grid.Column>
              </Grid.Row>
          </Grid>
        </Accordion> 
       : '' }  

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
export default SingularSchemaEdit;