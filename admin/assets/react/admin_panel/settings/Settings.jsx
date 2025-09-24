import React, { useState, useEffect, useReducer } from 'react';
import queryString from 'query-string'
import SettingsNavLink from './../settings-nav-link/SettingsNavLink'
import { Button, Input, Icon, Popup, Checkbox, TextArea, Dropdown, Divider } from 'semantic-ui-react'
import MediaUpload from '../../shared/mediaUpload/MediaUpload'
import MainSpinner from './../common/main-spinner/MainSpinner';
import LicensePage from '../license/LicensePage';

import './Settings.css';

const Settings = () => {

  const [loading, setLoading]                 = useState(false);  
  const [isLoaded, setIsLoaded]               = useState(true);  
  const [isQuerySent, setIsQuerySent]         = useState(true);  
  const [mainSpinner, setMainSpinner]         = useState(false);    
  const [supportEmail, setSupportEmail]       = useState('');  
  const [supportMessage, setSupportMessage]   = useState('');
  const [supportError, setSupportError]       = useState('');
  const [supportSuccess, setSupportSuccess]   = useState('');
  const [importFile, setImportFile]           = useState();
  const [spgTaxonomies, setSPGTaxonomies]     = useState([]);
  const [spgPostTypes, setSPGPostTypes]       = useState([]);
  const [pluginList, setPluginList]           = useState({});

  const postMetaReducer = (state, newState) => {
    if (typeof newState === "function") {
      return { ...state, ...newState(state) }; // Handles function-based updates
    }
    return { ...state, ...newState };
  };


  const [settings, setSettings] = useReducer(postMetaReducer, {
        escaped_unicode_json:     true,
		    minified_json:            true,
        website_json_ld:          true,
        defragment_json_ld:       false,  
        json_ld_in_footer:        false,
        json_ld_in_rest:          false, 
        dynamic_placeholders:     false,        
        clean_micro_data:         false,  
        clean_rdfa_data:          false,  
        multisize_image:          false,
        image_object:             false,
        wpgraphql_cmp:            false,          
        simple_author_box_cmp:    false,        
        delete_data_on_uninstall: false,      
        default_logo_id:          null,
        default_image_id:         null,
        default_logo_url:         '',
        default_image_url:        '',
        manage_conflict  :        [],
        spg_post_types   :        [],
        spg_taxonomies   :        [],
        spg_author       :        false
    });
          
  const page = queryString.parse(window.location.search);   
  const {__} = wp.i18n;         

  const formChangeHandler = (event) => {
              
    let { name, value, type } = event.target;

    if(event.target.type === 'file'){

      const file = event.target.files[0];

      if (file && file.type !== "application/json" && !file.name.endsWith(".json")) {
          alert("Only JSON files are allowed!");
          event.target.value = ""; // Clear file input
          return;
      }

      setImportFile( file );

    }else{

      if(type === "checkbox"){
        value = event.target.checked;
      }

      setSettings({[name]: value});

    }      
       
  }

  const saveSettings = () => {                 

    setIsLoaded(false);
    const formData = new FormData();

    if(typeof importFile !== 'undefined'){
      formData.append("file", importFile);        
    }        
    formData.append("settings", JSON.stringify(settings));    
    let url = smpg_local.rest_url + 'update-settings';
    fetch(url,{
      method: "post",
      headers: {
        'Accept': 'application/json', 
        'X-WP-Nonce': smpg_local.nonce,         
      },        
      body: formData
    })
    .then(res => res.json())
    .then(
      (result) => {  

        if(result['file_status'] == 't'){
          window.location.reload();
        }
        setIsLoaded(true);          
      },        
      (error) => {
       
      }
    ); 
    
  }

  const getSettings = () => {

    
    setMainSpinner(true);

    let url = smpg_local.rest_url + "get-settings";
      
      fetch(url, {
        headers: {                    
          'X-WP-Nonce': smpg_local.nonce,
        }
      })
      .then(res => res.json())
      .then(
        (result) => {         
    
            setMainSpinner(false);
            
          if(result){
            setSPGPostTypes(result.post_types);
            setSPGTaxonomies(result.taxonomies);
            setSettings(result.smpg_settings);
          }          
            
        },        
        (error) => {
      
        }
      );            

  }
      
  const validateEmail = (email) => {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }

  const sendSupportQuery = (e) =>{
     e.preventDefault();       
    
     setTimeout(() => setSupportError(''), 3000);
     setTimeout(() => setSupportSuccess(''), 3000);
 
    if(supportEmail =='' || supportMessage == ''){

      if(supportEmail == ''){
        setSupportError('Email is required');
      }
      if(supportMessage == ''){
        setSupportError('Message is required');
      }
      
    }else{

      if(validateEmail(supportEmail)){

      const body_json       = {};                

      body_json.message  = supportMessage;
      body_json.email    = supportEmail;
      
      let url = smpg_local.rest_url + 'send-customer-query';

      setIsQuerySent(false);

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

          setIsQuerySent(true);

          setTimeout(() => setSupportError(''), 3000);
          setTimeout(() => setSupportSuccess(''), 3000);

            if(result.status == 't'){
              setSupportError('');
              setSupportSuccess('Thank You! Message sent successfully. We will contact you shortly');
            }else{
              setSupportError('Something went wrong. Please check your network connection');
              setSupportSuccess('');
            }                 
                                  
        },        
        (error) => {
          setSupportError('Error' + error);
        }
      );   

      }else{
        setSupportError('Enter a valid email');
      }
               
    }
     
  }
        
  const handleLogoImage = (data) => {

    setSettings({default_logo_id: data.id, default_logo_url: data.url});  

  }

  const handleDefaultImage = (data) => {

    setSettings({default_image_id: data.id, default_image_url: data.url});  

  }

  const handleGetPluginList = () => {

    let url = smpg_local.rest_url + "get-plugin-list" + (smpg_local.rest_url.includes("?") ? "&" : "?") + "filter=has_own_json_ld";
        
    fetch(url, {
      headers: {                    
        'X-WP-Nonce': smpg_local.nonce,
      }
    })
    .then(res => res.json())
    .then(
      (result) => {              
          if(result.status == 'success'){
            setPluginList(result.data);            
          }
      },        
      (error) => {         
      }
    ); 

  }
  const handleManageConflictChange = (e) => {
    
    let { name } = e.target;

    let copydata = {...settings};

    let index = copydata.manage_conflict.indexOf(name);

    if(index !== -1){  
      copydata.manage_conflict.splice(index, 1); 
    }else{
      copydata.manage_conflict.push(name);
    }
    setSettings(copydata);
    
  }

  const handleExport = async (e) => {
    e.preventDefault();
    setLoading(true);
    // setError(null);
    // setSuccess(null);
    try {
      let fetch_url = smpg_local.rest_url + 'export-settings';
      const response = await fetch(fetch_url,{
        headers: {          
          'X-WP-Nonce': smpg_local.nonce,                  
        },        
      });
      if (!response.ok) {
        throw new Error("Failed to export settings");
      }
      
      const blob = await response.blob();
      const url = window.URL.createObjectURL(blob);
      const link = document.createElement("a");
      link.href = url;
      link.setAttribute("download", "schema-package.json");
      document.body.appendChild(link);
      link.click();
      link.remove();

    //  setSuccess("Settings exported successfully.");
    } catch (error) {
      //setError("Failed to export settings. Please try again.");
    } finally {
      setLoading(false);
    }
  };
  
  const handleSaveSettings = (e) => {
    e.preventDefault();
    saveSettings();
  }  

  const handleSPGPostTypes = (e, data) => {    
    
    setSettings(prevState => ({
        ...prevState,
        spg_post_types: data.value
    }));
  };

  const handleSPGTaxonomies = (e, data) => {    
    
    setSettings(prevState => ({
        ...prevState,
        spg_taxonomies: data.value
    }));
  };

  
  useEffect(() => {
    getSettings();    
    handleGetPluginList();           
  }, [])

    return(
      <form encType="multipart/form-data" method="post" id="smpg_settings_form">  
      {mainSpinner ? <MainSpinner /> : ''}
      <div className="smpg-settings-content">          
      <SettingsNavLink />                   
      <div className="ui"> 
      {(() => {
        switch (page.path) {
          case "settings":   return (
            <div className="smpg-settings">              
            <div style={{ fontSize: '15px', marginBottom: '8px', fontWeight:600 }}>              
              <a
                href="https://schemapackage.com/knowledge-base/schema-package-general-settings/"
                target="_blank"
                rel="noopener noreferrer"
              >
                {__('Read Full Guide', 'schema-package')}    
              </a>
            </div>
            <Divider style={{ margin: '5px 0' }} />
              <table className="form-table">
                <tbody>
                <tr>
                    <th><label htmlFor="minified_json">{__('Minified JSON-LD', 'schema-package')}</label></th>
                    <td>
                    <Checkbox
                      name='minified_json'
                      id='minified_json'
                      checked={!!settings.minified_json}
                      onChange={formChangeHandler}
                    />                      
                      <span className="smpg-tooltip"><Popup content={__('Minified JSON-LD reduces file size and improves page load speed by removing unnecessary spaces and line breaks.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>                      
                  <tr>
                    <th><label htmlFor="escaped_unicode_json">{__('Escaped Unicode JSON-LD', 'schema-package')}</label></th>
                    <td>
                    <Checkbox
                      name='escaped_unicode_json'
                      id='escaped_unicode_json'
                      checked={!!settings.escaped_unicode_json}
                      onChange={formChangeHandler}
                    />                      
                      <span className="smpg-tooltip"><Popup content={__('Escaped Unicode (\\uXXXX) in JSON helps maintain data integrity, especially for special or multilingual characters.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>                                        
                  <tr>
                    <th><label htmlFor="clean_micro_data">{__('Clean MicroData', 'schema-package')}</label></th>
                    <td>
                    <Checkbox                     
                      name='clean_micro_data'
                      id='clean_micro_data' 
                      checked={!!settings.clean_micro_data}
                      onChange={formChangeHandler}
                    />                      
                      <span className="smpg-tooltip"><Popup content={__('Search engines and AI tools recommend using the JSON-LD format. This option will clean and remove all Microdata schema markup from your site.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>
                  <tr>
                    <th><label htmlFor="clean_rdfa_data">{__('Clean RDFA Data', 'schema-package')}</label></th>
                    <td>
                    <Checkbox                     
                      name='clean_rdfa_data'
                      id='clean_rdfa_data' 
                      checked={!!settings.clean_rdfa_data}
                      onChange={formChangeHandler}
                    />                      
                      <span className="smpg-tooltip"><Popup content={__('Search engines and AI tools recommend using the JSON-LD format. This option will clean and remove all RDFA schema markup from your site.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>
                  <tr>
                    <th><label htmlFor="image_object">{__('ImageObject', 'schema-package')}</label></th>
                    <td>
                    <Checkbox                     
                      name='image_object'
                      id='image_object' 
                      checked={!!settings.image_object}
                      onChange={formChangeHandler}
                    />                       
                      <span className="smpg-tooltip"><Popup content={__('By default, the image property accepts a URL. However, if you prefer to use the ImageObject type, enable this option.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>                                        
                </tbody>
              </table>
            </div>
          );
          case "settings_advanced":   return (
            <div className="smpg-settings">
              <div style={{ fontSize: '15px', marginBottom: '8px', fontWeight:600 }}>              
              <a
                href="https://schemapackage.com/knowledge-base/schema-package-advanced-settings/"
                target="_blank"
                rel="noopener noreferrer"
              >
                {__('Read Full Guide', 'schema-package')}    
              </a>
            </div>
            <Divider style={{ margin: '5px 0' }} />
              <table className="form-table">
                <tbody>                                                    
                  <tr>
                    <th><label htmlFor="dynamic_placeholders">{__('Dynamic Placeholders', 'schema-package')}</label></th>
                    <td>
                    <Checkbox                     
                      name='dynamic_placeholders'
                      id='dynamic_placeholders' 
                      checked={!!settings.dynamic_placeholders}
                      onChange={formChangeHandler}
                    />                      
                      <span className="smpg-tooltip"><Popup content={__('Automatically replace placeholders (like %%post_title%%, %%date_published%%) with actual post or site data when generating schema markup.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>                  
                  <tr>
                    <th><label htmlFor="json_ld_in_rest">{__('JSON-LD in Rest API', 'schema-package')}</label></th>
                    <td>
                    <Checkbox                     
                      name='json_ld_in_rest'
                      id='json_ld_in_rest' 
                      checked={!!settings.json_ld_in_rest}
                      onChange={formChangeHandler}
                    />                      
                      <span className="smpg-tooltip"><Popup content={__('Include the generated Schema.org JSON-LD markup in WordPress REST API responses for supported post types. Useful for headless setups or external integrations.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>                  
                  <tr>
                    <th><label htmlFor="multisize_image">{__('Multiple Size Images', 'schema-package')}</label></th>
                    <td>
                    <Checkbox                     
                      name='multisize_image'
                      id='multisize_image' 
                      checked={!!settings.multisize_image}
                      onChange={formChangeHandler}
                    />                      
                      <span className="smpg-tooltip"><Popup content={__('Generates multiple images from a single image based on search engine image recommendations. This may increase the size of the upload folder, so enable it if you are okay with that.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>                 
                </tbody>
              </table>
            </div>
          );
          case "settings_manageconflict":   return (
            <div className="smpg-settings">
              <div style={{ fontSize: '15px', marginBottom: '8px', fontWeight:600 }}>              
              <a
                href="https://schemapackage.com/knowledge-base/how-to-manage-conflicts-with-other-schema-and-structured-data-plugins/"
                target="_blank"
                rel="noopener noreferrer"
              >
                {__('Read Full Guide', 'schema-package')}    
              </a>
            </div>
            <Divider style={{ margin: '5px 0' }} />
              {Object.keys(pluginList).length > 0 ?
              <table className="form-table">
                <tbody>
                {
                Object.entries(pluginList).map(([key, value]) => {                   
                  return(
                   <tr key={key}>
                   <th><label htmlFor={key}>{value.name}</label></th>
                   <td>
                        <Checkbox                     
                          name={key}  
                          id={key}                        
                          checked={!!settings.manage_conflict.includes(key) ? true : false}
                          onChange={handleManageConflictChange}
                        />                                            
                    </td> 
                   </tr>
                 )
               })
              }        
              </tbody>      
           </table>
              : 
              <div className="ui positive message">
                <div className="header">
                  {__('No Conflicts Detected', 'schema-package')}
                </div>
                <p>{__('This plugin does not conflict with any other installed plugins.', 'schema-package')}</p>
              </div>
            }
            </div>  
          );
          case "settings_tools": return (
            <div className="smpg-settings">
              <div style={{ fontSize: '15px', marginBottom: '8px', fontWeight:600 }}>              
              <a
                href="https://schemapackage.com/knowledge-base/schema-package-import-export-settings/"
                target="_blank"
                rel="noopener noreferrer"
              >
                {__('Read Full Guide', 'schema-package')}    
              </a>
            </div>
            <Divider style={{ margin: '5px 0' }} />
              <table className="form-table">
                <tbody>
                <tr>
                    <th><strong>{__('SPG for Post Types', 'schema-package')}</strong></th>
                    <td>
                    <Dropdown
                      style={{maxWidth:"300px"}}
                      data_type="spg_post_types"
                      name="spg_post_types"
                      placeholder={__('Search For Post Types', 'schema-package') }
                      fluid
                      multiple
                      search
                      selection
                      value={settings.spg_post_types}
                      onChange={handleSPGPostTypes}                      
                      options={spgPostTypes}
                   />
                      {/* <span className="smpg-tooltip"><Popup content={__('It exports all the data related to this plugin in json format. Such as:- Schema Types, Settings etc.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>   */}
                    </td>
                </tr>
                <tr>
                    <th><strong>{__('SPG for Taxonomies', 'schema-package')}</strong></th>
                    <td>
                    <Dropdown
                      style={{maxWidth:"300px"}}
                      data_type="spg_taxonomies"
                      name="spg_taxonomies"
                      placeholder={__('Search For Taxonomies', 'schema-package') }
                      fluid
                      multiple
                      search
                      selection
                      value={settings.spg_taxonomies}
                      onChange={handleSPGTaxonomies}                      
                      options={spgTaxonomies}
                   />
                      {/* <span className="smpg-tooltip"><Popup content={__('It exports all the data related to this plugin in json format. Such as:- Schema Types, Settings etc.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>   */}
                    </td>
                </tr>  

                <tr>
                    <th><label htmlFor="spg_author">{__('SPG for Author', 'schema-package')}</label></th>
                    <td>
                      <Checkbox                     
                        name='spg_author'
                        id='spg_author' 
                        checked={!!settings.spg_author ? true : false}
                        onChange={formChangeHandler}
                      />                                            
                      {/* <span className="smpg-tooltip"><Popup content={__('It ensures all Schema Package related data, such as singular schema, carousel schema, and saved settings, are deleted when the application is uninstalled, helping maintain privacy and free up storage space.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>   */}
                      </td>
                  </tr>

                <tr>
                    <th><strong>{__('Export Data ', 'schema-package')}</strong></th>
                    <td>
                    <Button loading={loading} onClick={handleExport}>
                      <Icon name='download' />
                      {__('Export', 'schema-package')}
                    </Button>                      
                      <span className="smpg-tooltip"><Popup content={__('It exports all the data related to this plugin in json format. Such as:- Schema Types, Settings etc.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>
                  </tr>
                  <tr>
                    <th><strong>{__('Import Data', 'schema-package')}</strong></th>
                    <td style={{position:"relative"}}>
                    <div className="smpg-import-td" style={{float : "left"}}>
                      <div style={{ display: "flex", alignItems: "center", gap: "10px" }}>
                        <Input
                          style={{width:"163px"}}
                          value={importFile?.name ?? ""}
                          placeholder={__('Choose a file...', 'schema-package')}
                          readOnly
                          action={
                            <Button as="label" htmlFor="file-upload" primary>
                              {__('Choose', 'schema-package')}                              
                            </Button>
                          }
                        />                        
                        <input
                          id="file-upload"
                          type="file"
                          accept=".json"
                          hidden
                          onChange={formChangeHandler}
                        />      
                      </div>                                                              
                    </div>                                              
                    <span style={{float:'right', position:'absolute', left:"264px"}} className="smpg-tooltip"><Popup content={__('Restore your data back from previous imported file', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                      </td>
                  </tr>                  
                  <tr>
                    <th><label htmlFor="delete_data_on_uninstall">{__('Delete Data on Uninstall', 'schema-package')}</label></th>
                    <td>
                      <Checkbox                     
                        name='delete_data_on_uninstall'
                        id='delete_data_on_uninstall' 
                        checked={!!settings.delete_data_on_uninstall ? true : false}
                        onChange={formChangeHandler}
                      />                                            
                      <span className="smpg-tooltip"><Popup content={__('It ensures all Schema Package related data, such as singular schema, carousel schema, and saved settings, are deleted when Schema Package plugin is uninstalled, helping maintain privacy and free up storage space.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                      </td>
                  </tr>                      
                </tbody>
              </table>
            </div>
          );
          
          case "settings_compatibility":  return (
            <div className="smpg-settings">
              <div style={{ fontSize: '15px', marginBottom: '8px', fontWeight:600 }}>              
              <a
                href="https://schemapackage.com/knowledge-base/schema-package-compatibility-settings/"
                target="_blank"
                rel="noopener noreferrer"
              >
                {__('Read Full Guide', 'schema-package')}    
              </a>
            </div>
            <Divider style={{ margin: '5px 0' }} />
              <table className="form-table">
                <tbody>                                    
                  <tr>
                    <th><label htmlFor="wpgraphql_cmp">{__('WPGraphQL', 'schema-package')}</label></th>
                    <td>
                    <Checkbox                     
                      name='wpgraphql_cmp'
                      id='wpgraphql_cmp' 
                      checked={!!settings.wpgraphql_cmp}
                      onChange={formChangeHandler}
                    />                      
                      <span className="smpg-tooltip"><Popup content={__('Include the generated Schema.org JSON-LD markup in WPGraphQL responses. Useful for headless WordPress setups or external GraphQL-based integrations.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr> 
                </tbody>
              </table>
            </div>
          );
          case "settings_defaultdata":  return (
            <div className="smpg-settings">
              <div style={{ fontSize: '15px', marginBottom: '8px', fontWeight:600 }}>              
              <a
                href="https://schemapackage.com/knowledge-base/how-to-set-up-default-data-in-schema-package/"
                target="_blank"
                rel="noopener noreferrer"
              >
                {__('Read Full Guide', 'schema-package')}    
              </a>
            </div>
            <Divider style={{ margin: '5px 0' }} />
              <table className="form-table smpg-default-data-table">
                <tbody>
                  <tr>
                   <th>{__('Logo', 'schema-package')}</th>
                   <td>

                   <MediaUpload onSelection={handleLogoImage} src={settings.default_logo_url}/>                     
                     <span className="smpg-tooltip"><Popup content={__('Logo size must be 160*50 or 600*60', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                   </td> 
                  </tr>
                  <tr>
                   <th>{__('Image', 'schema-package')}</th>
                   <td>                     
                      <MediaUpload onSelection={handleDefaultImage} src={settings.default_image_url}/>
                     <span className="smpg-tooltip"><Popup content={__('When a post does not have featured image, It will be added to Json-Ld image field to remove warning from google testing tool', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                     </td> 
                  </tr>
                </tbody>
              </table>
            </div>
          );
          case "settings_license":  return (
            <div className="smpg-settings">
              <div style={{ fontSize: '15px', marginBottom: '8px', fontWeight:600 }}>              
              <a
                href="https://schemapackage.com/knowledge-base/category/payment-billing/"
                target="_blank"
                rel="noopener noreferrer"
              >
                {__('Read Full Guide', 'schema-package')}    
              </a>
            </div>
            <Divider style={{ margin: '5px 0' }} />                    
              <LicensePage />
            </div>
          );
          case "settings_help":  return (
            <div className="smpg-settings">
              <table className="form-table">
                <tbody>
                  <tr>
                  <th>{__('Reach Out via Email', 'schema-package')}</th>
                  <td>
                      <a href="mailto:support@schemapackage.com" style={{ fontWeight: 'bold' }}>support@schemapackage.com</a>
                  </td> 
                 </tr>                 
                 <tr>
                  <th>{__('Your Email', 'schema-package')}</th>
                  <td>
                    <Input 
                      style={{width:"297px"}}
                      icon="user"
                      iconPosition="left"                    
                      type="email"
                      placeholder={__('Your email', 'schema-package') } 
                      id="user_email"
                      name="user_email" 
                      value={supportEmail}
                      onChange={event => setSupportEmail(event.target.value)}
                    />
                    
                  </td> 
                 </tr>
                 <tr>
                  <th>{__('Your Query', 'schema-package')}</th>
                  <td>
                  <TextArea
                    value={supportMessage}
                    onChange={(event) => setSupportMessage(event.target.value)}
                    placeholder={__('Enter your query here...', 'schema-package') }
                    rows="6"
                    cols="38"
                    name="user_query"
                  />                    
                   </td> 
                 </tr>
                 <tr>
                  <th></th>
                  <td>
                  {isQuerySent ? <Button onClick={sendSupportQuery} >{__('Send', 'schema-package')}</Button> : <Button loading>{__('Loadingqq', 'schema-package') }</Button>} 
                  </td> 
                 </tr>
                </tbody> 
              </table>
              {supportSuccess ? <div className="ui green message">{supportSuccess}</div> : ''}
              {supportError ? <div className="ui red message">{supportError}</div> : ''}
            </div>
          );
          default: return "";
        }
      })()}
      { (page.path === 'settings_license' || page.path === 'settings_help') ? '' : 
        <div className="smpg-save-settings-btn">
        {isLoaded ? <Button primary onClick={handleSaveSettings}>{__('Save', 'schema-package')}</Button> : <Button loading primary>Loading</Button>}                  
      </div>}      
      </div>  
      {smpg_local.is_free ? 
      <div className='ui card' style={{
        backgroundColor: "#222222", // Change background color
        color:"#ffffff",        
        margin:"auto",
        marginRight:"inherit",
        marginTop:"0px"
      }}>
        <div className='content'>
        <div className='header' style={{color:"#ff9e00"}}>{__('Elevate with Premium Features!', 'schema-package')}</div>  
        <div className='ui list' role='list'>
          <div role="listitem" className="item"><i aria-hidden="true" className="check square large icon"></i><div className='content'>{__('WooCommerce Variable Product Automation', 'schema-package')}</div></div>
          <div role="listitem" className="item"><i aria-hidden="true" className="check square large icon"></i><div className='content'>{__('RealEstate Schema Types & Automation', 'schema-package')}</div></div>
          <div role="listitem" className="item"><i aria-hidden="true" className="check square large icon"></i><div className='content'>{__('Healthcare Schema Types & Automation', 'schema-package')}</div></div>
          <div role="listitem" className="item"><i aria-hidden="true" className="check square large icon"></i><div className='content'>{__('Carousel Schema Details Page List', 'schema-package')}</div></div>
          <div role="listitem" className="item"><i aria-hidden="true" className="check square large icon"></i><div className='content'>{__('Multilinugal Schema Markup Support', 'schema-package')}</div></div>
          <div role="listitem" className="item"><i aria-hidden="true" className="check square large icon"></i><div className='content'>{__('Advanced ACF/SCF Mapping', 'schema-package')}</div></div>
          <div role="listitem" className="item"><i aria-hidden="true" className="check square large icon"></i><div className='content'>{__('Schema Markup Setup & Error Clean Up', 'schema-package')}</div></div>
          <div role="listitem" className="item"><i aria-hidden="true" className="check square large icon"></i><div className='content'>{__('24/7 Priority Email Support', 'schema-package')}</div></div>
          <div role="listitem" className="item"><i aria-hidden="true" className="check square large icon"></i><div className='content'>{__('Premium Features on Demand', 'schema-package')}</div></div>                    
        </div> 
         <div style={{textAlign:"center"}}>
          <a target="_blank" href="https://schemapackage.com/premium#pricing" className="ui button upgrade-premium-btn">Unlock</a>
          </div>         
        </div>        
        </div>                  
      : ''}
      
      </div>
      </form>
    );
}
export default Settings;