import React from 'react';
import './AdminNavLink.css';
import {Link} from 'react-router-dom';
import queryString from 'query-string'
import { Button, Icon } from "semantic-ui-react";

const AdminNavLink = () => {

    const {__} = wp.i18n;    
    const page = queryString.parse(window.location.search); 
    let current = 'single';
    
    if(typeof(page.path)  != 'undefined' ) { 
      current = page.path;
    }

    return(                             
      <div>
          <div>
          <div className="ui pointing secondary menu">
          <Link  to={'admin.php?page=schema_package'} className={current == 'single' ? 'item active' : 'item'}><h3>{__('Singular Schema', 'schema-package')}</h3></Link>          
          <Link  to={'admin.php?page=schema_package&path=carousel_schema'} className={current == 'carousel_schema' ? 'item active' : 'item'}><h3>{__('Carousel Schema', 'schema-package')}</h3></Link>          
          <Link  to={'admin.php?page=schema_package&path=misc_schema'} className={current == 'misc_schema' ? 'item active' : 'item'}><h3>{__('Misc Schema', 'schema-package')}</h3></Link>          
          <Link  to={'admin.php?page=schema_package&path=settings'} className={(current == 'settings' || current == 'settings_tools' || current == 'settings_advanced' || current == 'settings_compatibility' || current == 'settings_defaultdata' || current == 'settings_help' || current == 'settings_manageconflict' || current == 'settings_license' ) ? 'item active' : 'item'}><h3>{__('Settings', 'schema-package')}</h3></Link>                              

            <div className="right menu">
              <div className="item">
                { smpg_local.is_free ?
                 <a target='_blank' href='https://schemapackage.com/premium/' className="ui button upgrade-premium-btn">{__('Upgrade to Premium', 'schema-package')}</a>
                : ''}                
                {/* <Button
                      as="a"
                      href="https://schemapackage.com/knowledge-base/"
                      target="_blank"
                      circular
                      rel="noopener noreferrer"
                      icon
                      secondary
                      style={{marginLeft:"15px"}}
                    >
                  <Icon name="help" />
                </Button>                 */}
              </div>
            </div>
                                         
          </div>                                                  
        </div>   
        </div>        
  
  );
  
}
export default AdminNavLink;