import React, { useEffect, useState,useReducer } from 'react';
import { Checkbox, Popup, Button, Dropdown } from 'semantic-ui-react'
import MainSpinner from './../common/main-spinner/MainSpinner';

import './MiscSchema.css';

const MiscSchema = () => {

  const {__} = wp.i18n;         

  const [mainSpinner, setMainSpinner]               = useState(false);
  const [aboutPageList, setAboutPageList]           = useState([]);
  const [siteNavigationList, setSiteNavigationList] = useState([]);
  const [contactPageList, setContactPageList]       = useState([]);
  const [isLoaded, setIsLoaded]                     = useState(true);

  const [miscSchema, setMiscSchema] = useReducer(
    (state, newState) => ({...state, ...newState}),
    {
      website              : true,      
      sitelinks_search_box : false,
      breadcrumbs          : false,
      profilepage          : false,
      about_pages          : [],
      site_navigations     : [],
      contact_pages        : []
    }            
  );

  const formChangeHandler = (event) => {
              
    let { name, value, type } = event.target;

    if(type === "checkbox"){
      value = event.target.checked;
    }

    setMiscSchema({[name]: value});      
       
  }

  const handleSaveMiscSchema = (e) => {
    e.preventDefault();

    setIsLoaded(false);
    const formData = new FormData();
            
    formData.append("misc_schema", JSON.stringify(miscSchema));    
    let url = smpg_local.rest_url + 'smpg-route/update-misc-schema';
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
        
        setIsLoaded(true);          
      },        
      (error) => {
       
      }
    );
      
  }

  const getMiscSchema = () => {
    
      setMainSpinner(true);

      let url = smpg_local.rest_url + "smpg-route/get-misc-schema";
      
      fetch(url, {
        headers: {                    
          'X-WP-Nonce': smpg_local.nonce,
        }
      })
      .then(res => res.json())
      .then(
        result => {          
                 
          setAboutPageList(Array.from(new Set(result.about_pages.map(JSON.stringify))).map(JSON.parse));
          setContactPageList( Array.from(new Set(result.contact_pages.map(JSON.stringify))).map(JSON.parse));
          setSiteNavigationList( Array.from(new Set(result.site_navigations.map(JSON.stringify))).map(JSON.parse));
          setMiscSchema(result.misc_schema);
          setMainSpinner(false);
        }        
      ).catch(error => {
        console.error('Error:', error);
      });

  }
   
  const handlePageChange = (e, data) => {
    
    let copydata = {...miscSchema};

    if((data.name).includes('about_page')){
      copydata.about_pages = data.value;
    }

    if((data.name).includes('contact_page')){
      copydata.contact_pages = data.value;
    }

    if((data.name).includes('site_navigation')){
      copydata.site_navigations = data.value;
    }
    
    setMiscSchema(copydata);    

  }

  const handlePlacementSearch = (search, name) => {
    
    let url = smpg_local.rest_url + "smpg-route/placement-search?type=page&search="+search;

    if((name).includes('site_navigation')){
        url = smpg_local.rest_url + "smpg-route/placement-search?type=menu&search="+search;
    }
          
    fetch(url, {
      headers: {                    
        'X-WP-Nonce': smpg_local.nonce,
      }
    })
    .then(res => res.json())
    .then(
      result => {
                            
        if(result){                    
                          
            if((name).includes('about_page')){
                            
                let newclone = [...new Set([...aboutPageList ,...result])]
                let newData = Array.from(new Set(newclone.map(JSON.stringify))).map(JSON.parse);    
               setAboutPageList(newData);
            }

            if((name).includes('contact_page')){
                            
                let newclone = [...new Set([...aboutPageList ,...result])]
                let newData = Array.from(new Set(newclone.map(JSON.stringify))).map(JSON.parse);    
                setContactPageList(newData);
            }

            if((name).includes('site_navigation')){
                            
                let newclone = [...new Set([...siteNavigationList ,...result])]
                let newData = Array.from(new Set(newclone.map(JSON.stringify))).map(JSON.parse);    
                setSiteNavigationList(newData);
            }
                        
        }
                  
      },        
      
    ).catch(error => {
      console.error('Error:', error);
    });

}

  let timer;
  const handlePageSearch = (e, data) => {

      let name   = data.name;
      let search = data.searchQuery;

      if(name && search){
        clearTimeout(timer);
        timer = setTimeout(()=> handlePlacementSearch(search, name), 1000)            
      }

  }

  useEffect(() => {        
    getMiscSchema();
  }, [])

  return(
    <>    
    <form encType="multipart/form-data" method="post" id="smpg_misc_schema_form">
    {mainSpinner ? <MainSpinner /> : ''}
      <div className="smpg-misc-table-div">      
      <table className="form-table smpg-misc-table">
      <tbody>
        <tr>
          <td><label htmlFor="website"><strong>{__('Website', 'schema-package')}</strong></label></td>
          <td>
                <Checkbox                     
                      name='website'
                      id='website' 
                      checked={!!miscSchema.website}
                      onChange={formChangeHandler}
                />                                    
              <span className="smpg-tooltip"><Popup content={__('Helps search engines understand the content of your site. It appears on homepage only.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} />
              <a className='smpg-learn-more' target="_blank" href='https://schemapackage.com/knowledge-base/what-is-a-website-schema-and-how-can-it-be-set-up-using-the-schema-package/'>{__('Learn More', 'schema-package')}</a>
              </span>  
          </td>
        </tr>
        {
          miscSchema.website ?
          <tr>
            <td className="smpg-sub-el"><label htmlFor="sitelinks_search_box"><strong>{__('Sitelinks Search Box', 'schema-package')}</strong></label></td>
            <td>
                <Checkbox                     
                      name='sitelinks_search_box'
                      id='sitelinks_search_box' 
                      checked={!!miscSchema.sitelinks_search_box}
                      onChange={formChangeHandler}
                />                
                <span className="smpg-tooltip"><Popup content={__('A sitelinks search box is a quick way for people to search your site or app immediately on the search results page.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} /></span>                  
            </td>
          </tr> 
          : ''
        }        
        <tr>
          <td><label htmlFor="breadcrumbs"><strong>{__('Breadcrumbs', 'schema-package')}</strong></label></td>
          <td>
                <Checkbox                     
                      name='breadcrumbs'
                      id='breadcrumbs' 
                      checked={!!miscSchema.breadcrumbs}
                      onChange={formChangeHandler}
                />              
              <span className="smpg-tooltip"><Popup content={__("A breadcrumb trail on a page indicates the page's position in the site hierarchy, and it may help users understand and explore a site effectively.", 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} />
              <a className='smpg-learn-more' target="_blank" href='https://schemapackage.com/knowledge-base/what-is-a-breadcrumb-schema-and-how-can-it-be-set-up-using-the-schema-package/'>{__('Learn More', 'schema-package')}</a>
              </span>  
          </td>
        </tr>
        <tr>
          <td><label htmlFor="profilepage"><strong>{__('Profile Page', 'schema-package')}</strong></label></td>
          <td>
                <Checkbox                     
                      name='profilepage'
                      id='profilepage' 
                      checked={!!miscSchema.profilepage}
                      onChange={formChangeHandler}
                />              
              <span className="smpg-tooltip"><Popup content={__("Showcase the author's biography, expertise, and social profiles for a richer, more engaging author page.", 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} />
                <a className='smpg-learn-more' target="_blank" href='https://schemapackage.com/knowledge-base/what-is-a-profilepage-schema-and-how-can-it-be-set-up-using-the-schema-package/'>{__('Learn More', 'schema-package')}</a>
              </span>  
          </td>
        </tr>
        <tr>
          <td><strong>{__('Site Navigation Element', 'schema-package') }</strong></td>
          <td>
                    <Dropdown
                      data_type="site_navigation"
                      name="site_navigation"
                      placeholder={__('Search for Menus', 'schema-package') }
                      fluid
                      multiple
                      search
                      selection
                      value={miscSchema.site_navigations}
                      onChange={handlePageChange}
                      onSearchChange={handlePageSearch}
                      options={siteNavigationList}
                   />
                   <span className="smpg-tooltip"><Popup content={__('Helps search engines understand the structure of your site\'s navigation menus and how different pages are connected.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} />
                    <a className='smpg-learn-more' target="_blank" href='https://schemapackage.com/knowledge-base/what-is-a-sitenavigationelement-schema-and-how-can-it-be-set-up-using-the-schema-package/'>{__('Learn More', 'schema-package')}</a>
                   </span>  
          </td>
        </tr>
        <tr>
          <td><strong>{__('About Pages', 'schema-package') }</strong></td>
          <td>
                    <Dropdown
                      data_type="about_page"
                      name="about_page"
                      placeholder={__('Search for Page', 'schema-package') }
                      fluid
                      multiple
                      search
                      selection
                      value={miscSchema.about_pages}
                      onChange={handlePageChange}
                      onSearchChange={handlePageSearch}
                      options={aboutPageList}
                   />
                   <span className="smpg-tooltip"><Popup content={__('Helps search engines understand the content and purpose of an "About Us" page on a website.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} />
                   <a className='smpg-learn-more' target="_blank" href='https://schemapackage.com/knowledge-base/what-is-an-aboutpage-schema-and-how-can-it-be-set-up-using-the-schema-package/'>{__('Learn More', 'schema-package')}</a>
                   </span>  
          </td>
        </tr>
        <tr>
          <td><strong>{__('Contact Pages', 'schema-package') }</strong></td>
          <td>
                    <Dropdown
                      data_type="contact_page"
                      name="contact_page"
                      placeholder={__('Search for Page', 'schema-package') }
                      fluid
                      multiple
                      search
                      selection
                      value={miscSchema.contact_pages}
                      onChange={handlePageChange}
                      onSearchChange={handlePageSearch}
                      options={contactPageList}
                   />
                   <span className="smpg-tooltip"><Popup content={__('Helps search engines understand the content and purpose of an "Contact Us" page on a website.', 'schema-package') } trigger={<i aria-hidden="true" className="question circle outline icon"/>} />
                   <a className='smpg-learn-more' target="_blank" href='https://schemapackage.com/knowledge-base/what-is-a-contactpage-schema-and-how-can-it-be-set-up-using-the-schema-package/'>{__('Learn More', 'schema-package')}</a>
                   </span>  
          </td>
        </tr>
      </tbody>
      </table>
      </div>
      <div className="smpg-save-misc-schema-btn">
        {isLoaded ? <Button primary onClick={handleSaveMiscSchema}>{__('Save', 'schema-package')}</Button> : <Button loading primary>{__('Loading', 'schema-package') }</Button>}
        </div>    
    </form>
    </>
  )
}
export default MiscSchema;