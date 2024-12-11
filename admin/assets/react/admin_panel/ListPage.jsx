import React, { Component} from 'react';
import queryString from 'query-string'
import {Route} from 'react-router-dom';
import SingleSchema from './single_schema/SingleSchema'
import ArchiveSchema from './archive_schema/ArchiveSchema'
import Settings from './settings/Settings'
import AdminNavLink from './admin-nav-link/AdminNavLink'
import MiscSchema from './misc_schema/MiscSchema';
import './style/common.css';

const ListPage = () => {

    return(
        <>  
          <AdminNavLink />
            <div className="ui segment smpg-list-page-container">
                <Route render={props => {                                        
                const page = queryString.parse(window.location.search); 
                                                    
                    if(typeof(page.path)  == 'undefined' ) {                           
                        return <SingleSchema  {...props}/>;                         
                    }
                    else if(page.path == 'misc_schema') {
                        return <MiscSchema  {...props}/>;
                    }                        
                    // else if(page.path == 'archive_schema') {
                    //     return <ArchiveSchema  {...props}/>;
                    // }
                    else if(page.path.includes('settings')) {
                        return <Settings  {...props}/>;
                    }
                    else{
                        return null;
                    }                    
            }}/> 
          </div>
          </>
          ); 
}
export default ListPage;