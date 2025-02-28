import React, { useState, useEffect, useReducer } from 'react';
import queryString from 'query-string'
import SettingsNavLink from './../settings-nav-link/SettingsNavLink'
import { Popup } from 'semantic-ui-react'
import MediaUpload from '../../shared/mediaUpload/MediaUpload'
import { Button } from 'semantic-ui-react'
import MainSpinner from './../common/main-spinner/MainSpinner';

import './Settings.css';

const Settings = () => {

  const [isLoaded, setIsLoaded]               = useState(true);  
  const [isQuerySent, setIsQuerySent]         = useState(true);  
  const [mainSpinner, setMainSpinner]         = useState(false);    
  const [supportEmail, setSupportEmail]       = useState('');
  const [supportMessage, setSupportMessage]   = useState('');
  const [supportError, setSupportError]       = useState('');
  const [supportSuccess, setSupportSuccess]   = useState('');
  const [importFile, setImportFile]           = useState();
  const [pluginList, setPluginList]           = useState({});


  const [settings, setSettings] = useReducer(
    (state, newState) => ({...state, ...newState}),
    {
      website_json_ld:          false,
      defragment_json_ld:       false,  
      json_ld_in_footer:        false,  
      pretty_print_json_ld:     false,  
      clean_micro_data:         false,  
      clean_rdfa_data:          false,  
      multisize_image:          false,  
      cmp_ampforwp:             false,              
      cmp_ampforwp:             false,
      cmp_amp_by_automatic:     false,
      cmp_better_amp:           false,
      cmp_wp_amp:               false,
      cmp_amp_wp:               false,
      cmp_smartcrawl_seo:       false,
      cmp_seo_press:            false,
      cmp_the_seo_framework:    false,
      cmp_all_in_one_seo_pack:  false,
      cmp_rank_math:            false,
      cmp_simple_author_box:    false,
      reset_settings:           false,
      remove_data_on_uninstall: false,      
      default_logo_id:          null,
      default_image_id:         null,
      default_logo_url:         null,
      default_image_url:        null,
      manage_conflict  :        []
    }            
  );
          
  const page = queryString.parse(window.location.search);   
  const {__} = wp.i18n;         

  const formChangeHandler = (event) => {
              
    let { name, value, type } = event.target;

    if(event.target.type === 'file'){

       value = event.target.files[0];       
       setImportFile(value);

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
        
    formData.append("file", importFile);        
    formData.append("settings", JSON.stringify(settings));    
    let url = smpg_local.rest_url + 'smpg-route/update-settings';
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

    let url = smpg_local.rest_url + "smpg-route/get-settings";
      
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
            setSettings(result);
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
      
      let url = smpg_local.rest_url + 'smpg-route/send-customer-query';

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

    let url = smpg_local.rest_url + "smpg-route/get-plugin-list?filter=has_own_json_ld";
        
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
            console.log(result.data);
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
  
  const handleSaveSettings = (e) => {
    e.preventDefault();
    saveSettings();
  }  

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
              <table className="form-table">
                <tbody>                  
                  <tr>
                    <th><label htmlFor="clean_micro_data">{__('Clean MicroData', 'schema-package')}</label></th>
                    <td>
                      <input type="checkbox" id="clean_micro_data" name="clean_micro_data" onChange={formChangeHandler} checked={settings.clean_micro_data} />
                      <span className="smpg-tooltip"><Popup content={__('Search engines and AI tools recommend using the JSON-LD format. This option will clean and remove all Microdata schema markup from your site.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>
                  <tr>
                    <th><label htmlFor="clean_rdfa_data">{__('Clean RDFA Data', 'schema-package')}</label></th>
                    <td>
                      <input type="checkbox" id="clean_rdfa_data" name="clean_rdfa_data" onChange={formChangeHandler} checked={settings.clean_rdfa_data} />
                      <span className="smpg-tooltip"><Popup content={__('Search engines and AI tools recommend using the JSON-LD format. This option will clean and remove all RDFA schema markup from your site.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>
                  <tr>
                    <th><label htmlFor="multisize_image">{__('Multiple Size Images', 'schema-package')}</label></th>
                    <td>
                      <input type="checkbox" id="multisize_image" name="multisize_image" onChange={formChangeHandler} checked={settings.multisize_image} />
                      <span className="smpg-tooltip"><Popup content={__('It generates multiple images from a single image based on search engine image recommendations. This may increase the size of the upload folder, so enable it if you are okay with that.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>                      
                </tbody>
              </table>
            </div>
          );
          case "settings_manageconflict":   return (
            <div className="smpg-settings">
              {Object.keys(pluginList).length > 0 ?
              <table className="form-table">
                <tbody>
                {
                Object.entries(pluginList).map(([key, value]) => {                   
                  return(
                   <tr key={key}>
                   <th><label htmlFor={key}>{value.name}</label></th>
                   <td><input type="checkbox" name={key} onChange={handleManageConflictChange} checked={ settings.manage_conflict.includes(key) ? true : false } /></td> 
                   </tr>
                 )
               })
              }        
              </tbody>      
           </table>
              : <div>{__('There is no any conflict with other plugins', 'schema-package') }</div>}
            </div>  
          );
          case "settings_tools": return (
            <div className="smpg-settings">
              <table className="form-table">
                <tbody>
                <tr>
                    <th><label htmlFor="export_smpg">{__('Export Data ', 'schema-package')}</label></th>
                    <td>
                      <a href={`${smpg_local.rest_url}smpg-route/export-settings`} className="button" id="export_smpg" name="export_smpg"><i className="ui download icon"></i> {__('Export', 'schema-package')}</a>
                      <span className="smpg-tooltip"><Popup content={__('It exports all the data related to this plugin in json format. Such as:- Schema Types, Settings etc.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>
                  </tr>
                  <tr>
                    <th><label htmlFor="import_smpg">{__('Import Data', 'schema-package')}</label></th>
                    <td>
                    <div className="smpg-import-td">
                    <input type="file" name="file" id="import_smpg" onChange={formChangeHandler}  />                    
                    <span className="smpg-tooltip"><Popup content={__('Restore your data back from previous imported file', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </div>                                              
                      </td>
                  </tr>                  
                  <tr>
                    <th><label htmlFor="remove_data_on_uninstall">{__('Remove Data On Uninstall', 'schema-package')}</label></th>
                    <td>
                      <input type="checkbox" id="remove_data_on_uninstall" name="remove_data_on_uninstall" onChange={formChangeHandler} checked={settings.remove_data_on_uninstall} />
                      <span className="smpg-tooltip"><Popup content={__('It ensures all Schema Package related data, such as singular schema, carousel schema, and saved settings, are deleted when the application is uninstalled, helping maintain privacy and free up storage space.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                      </td>
                  </tr>                      
                </tbody>
              </table>
            </div>
          );
          
          case "settings_compatibilitys":  return (
            <div className="smpg-settings">
              <table className="form-table">
                <tbody>
                  <tr>
                    <th><label htmlFor="cmp_ampforwp">{__('AMPforWP', 'schema-package')}</label></th>
                    <td>
                      <input type="checkbox" id="cmp_ampforwp" name="cmp_ampforwp" onChange={formChangeHandler} checked={settings.cmp_ampforwp} />
                      <span className="smpg-tooltip"><Popup content={__('Add users to your feed', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                      </td>  
                  </tr>
                  <tr>
                    <th><label htmlFor="cmp_amp_by_automatic">{__('AMP By Automatic', 'schema-package')}</label></th>
                    <td>
                      <input type="checkbox" id="cmp_amp_by_automatic" name="cmp_amp_by_automatic" onChange={formChangeHandler} checked={settings.cmp_amp_by_automatic} />
                      <span className="smpg-tooltip"><Popup content={__('Add users to your feed', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>                                                      
                  <tr>
                    <th><label htmlFor="cmp_smartcrawl_seo">{__('SmartCrawl Seo', 'schema-package')}</label></th>
                    <td>
                      <input type="checkbox" id="cmp_smartcrawl_seo" name="cmp_smartcrawl_seo" onChange={formChangeHandler} checked={settings.cmp_smartcrawl_seo} />
                      <span className="smpg-tooltip"><Popup content={__('Add users to your feed', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>
                  <tr>
                    <th><label htmlFor="cmp_seo_press">{__('SEOPress', 'schema-package')}</label></th>
                    <td>
                      <input type="checkbox" id="cmp_seo_press" name="cmp_seo_press" onChange={formChangeHandler} checked={settings.cmp_seo_press} />
                      <span className="smpg-tooltip"><Popup content={__('Add users to your feed', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                      </td>  
                  </tr>
                  <tr>
                    <th><label htmlFor="cmp_the_seo_framework">{__('The SEO Framework', 'schema-package')}</label></th>
                    <td>
                      <input type="checkbox" id="cmp_the_seo_framework" name="cmp_the_seo_framework" onChange={formChangeHandler} checked={settings.cmp_the_seo_framework} />
                      <span className="smpg-tooltip"><Popup content={__('Add users to your feed', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>
                  <tr>
                    <th><label htmlFor="cmp_all_in_one_seo_pack">{__('All in One SEO Pack', 'schema-package')}</label></th>
                    <td>
                      <input type="checkbox" id="cmp_all_in_one_seo_pack" name="cmp_all_in_one_seo_pack" onChange={formChangeHandler} checked={settings.cmp_all_in_one_seo_pack} />
                      <span className="smpg-tooltip"><Popup content={__('Add users to your feed', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                      </td>  
                  </tr>
                  <tr>
                    <th><label htmlFor="cmp_squirrly">{__('Squirrly Seo', 'schema-package')}</label></th>
                    <td>
                      <input type="checkbox" id="cmp_squirrly" name="cmp_squirrly" onChange={formChangeHandler} checked={settings.cmp_squirrly} />
                      <span className="smpg-tooltip"><Popup content={__('Add users to your feed', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>
                  <tr>
                    <th><label htmlFor="cmp_rank_math">{__('Rank Malth', 'schema-package')}</label></th>
                    <td>
                      <input type="checkbox" id="cmp_rank_math" name="cmp_rank_math" onChange={formChangeHandler} checked={settings.cmp_rank_math} />
                      <span className="smpg-tooltip"><Popup content={__('Add users to your feed', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                      </td>  
                  </tr>
                  <tr>
                    <th><label htmlFor="multisize_image">{__('Total Recipe Generator', 'schema-package')}</label></th>
                    <td>
                      <input type="checkbox" id="multisize_image" name="multisize_image" onChange={formChangeHandler} checked={settings.multisize_image} />
                      <span className="smpg-tooltip"><Popup content={__('Add users to your feed', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                    </td>  
                  </tr>
                  <tr>
                    <th><label htmlFor="cmp_simple_author_box">{__('Simple Author Box', 'schema-package')}</label></th>
                    <td>
                      <input type="checkbox" id="cmp_simple_author_box" name="cmp_simple_author_box" onChange={formChangeHandler} checked={settings.cmp_simple_author_box} />
                      <span className="smpg-tooltip"><Popup content={__('Add users to your feed', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>  
                      </td>  
                  </tr>                      
                </tbody>
              </table>
            </div>
          );
          case "settings_defaultdata":  return (
            <div className="smpg-settings">
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
          case "settings_help":  return (
            <div className="smpg-settings">
              <table className="form-table">
                <tbody>
                 <tr>
                  <th>{__('Email', 'schema-package')}</th>
                  <td><input 
                    placeholder={__('Your email id', 'schema-package') } 
                    type="text" 
                    name="user_email" 
                    value={supportEmail} 
                    onChange={event => setSupportEmail(event.target.value)}
                  /></td> 
                 </tr>
                 <tr>
                  <th>{__('Query', 'schema-package')}</th>
                  <td><textarea
                   value={supportMessage} 
                   onChange={event => setSupportMessage(event.target.value)}
                   placeholder={__('Type your query here...', 'schema-package') } 
                   cols="40" 
                   rows="6" name="user_query" 
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
          default:      return "generla";
        }
      })()}
      <div className="smpg-save-settings-btn">
        {isLoaded ? <Button primary onClick={handleSaveSettings}>{__('Save', 'schema-package')}</Button> : <Button loading primary>Loading</Button>}                  
        </div>
      </div>                    
      </div>
      </form>
    );
}
export default Settings;