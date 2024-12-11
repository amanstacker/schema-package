import React from 'react';
import './SettingsNavLink.css';
import {Link} from 'react-router-dom';
import queryString from 'query-string'

const SettingsNavLink = () => {

    const {__} = wp.i18n;    
    const page = queryString.parse(window.location.search); 
    let current = 'settings';
    
    if(typeof(page.path)  != 'undefined' ) { 
      current = page.path;
    }                        

    return(                             
      <div>
          <div>
          <div className="ui pointing secondary vertical menu">
          <Link  to={'admin.php?page=schema_package&path=settings'} className={current == 'settings' ? 'item active' : 'item'}>{__('General', 'schema-package')}</Link>
          <Link  to={'admin.php?page=schema_package&path=settings_manageconflict'} className={current == 'settings_manageconflict' ? 'item active' : 'item'}>{__('Manage Conflict', 'schema-package')}</Link>                                                          
          <Link  to={'admin.php?page=schema_package&path=settings_defaultdata'} className={current == 'settings_defaultdata' ? 'item active' : 'item'}>{__('Default Data', 'schema-package')}</Link>                                
          <Link  to={'admin.php?page=schema_package&path=settings_tools'} className={current == 'settings_tools' ? 'item active' : 'item'}>{__('Tools', 'schema-package')}</Link>                                
          <Link  to={'admin.php?page=schema_package&path=settings_help'} className={current == 'settings_help' ? 'item active' : 'item'}>{__('Help & Support', 'schema-package')}</Link>                                
          </div>                                                  
        </div>   
        </div>        
  
  );
}
export default SettingsNavLink;