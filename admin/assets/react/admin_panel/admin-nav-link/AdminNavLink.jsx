import React from 'react';
import './AdminNavLink.css';
import {Link} from 'react-router-dom';
import queryString from 'query-string'


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
          <Link  to={'admin.php?page=schema_package'} className={current == 'single' ? 'item active' : 'item'}>{__('Single Schema', 'schema-package')}</Link>
          <Link  to={'admin.php?page=schema_package&path=misc_schema'} className={current == 'misc_schema' ? 'item active' : 'item'}>{__('Misc Schema', 'schema-package')}</Link>          
          <Link  to={'admin.php?page=schema_package&path=settings'} className={(current == 'settings' || current == 'settings_tools' || current == 'settings_advanced' || current == 'settings_compatibility' || current == 'settings_defaultdata' || current == 'settings_help' || current == 'settings_manageconflict' ) ? 'item active' : 'item'}>{__('Settings', 'schema-package')}</Link>                    
          </div>                                                  
        </div>   
        </div>        
  
  );
  
}
export default AdminNavLink;