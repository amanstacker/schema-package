import React from 'react';
import './SettingsNavLink.css';
import {Link} from 'react-router-dom';
import queryString from 'query-string'
import { Icon } from "semantic-ui-react";

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
            <Link  to={'admin.php?page=schema_package&path=settings'} className={current == 'settings' ? 'item active' : 'item'}><h4><Icon name="cogs" /> {__('General', 'schema-package')}</h4></Link>
            <Link  to={'admin.php?page=schema_package&path=settings_advanced'} className={current == 'settings_advanced' ? 'item active' : 'item'}><h4><Icon name="options" /> {__('Advanced', 'schema-package')}</h4></Link>
            <Link  to={'admin.php?page=schema_package&path=settings_manageconflict'} className={current == 'settings_manageconflict' ? 'item active' : 'item'}><h4><Icon name="exclamation triangle" /> {__('Manage Conflict', 'schema-package')}</h4></Link>
            <Link  to={'admin.php?page=schema_package&path=settings_compatibility'} className={current == 'settings_compatibility' ? 'item active' : 'item'}><h4><Icon name="plug" /> {__('Compatibility', 'schema-package')}</h4></Link>
            <Link  to={'admin.php?page=schema_package&path=settings_defaultdata'} className={current == 'settings_defaultdata' ? 'item active' : 'item'}><h4><Icon name="database" /> {__('Default Data', 'schema-package')}</h4></Link>
            <Link  to={'admin.php?page=schema_package&path=settings_tools'} className={current == 'settings_tools' ? 'item active' : 'item'}><h4><Icon name="wrench" /> {__('Tools', 'schema-package')}</h4></Link>
            { smpg_local.is_free ? '' : <Link  to={'admin.php?page=schema_package&path=settings_license'} className={current == 'settings_license' ? 'item active' : 'item'}><h4> <Icon name="certificate" />{__('License', 'schema-package')}</h4></Link> }            
            <Link  to={'admin.php?page=schema_package&path=settings_help'} className={current == 'settings_help' ? 'item active' : 'item'}><h4><Icon name="help circle" /> {__('Help & Support', 'schema-package')}</h4></Link>
          </div>                                                  
        </div>   
        </div>        
  
  );
}
export default SettingsNavLink;