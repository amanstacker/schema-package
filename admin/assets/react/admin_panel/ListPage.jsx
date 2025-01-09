import React, { Component} from 'react';
import queryString from 'query-string'
import {Route} from 'react-router-dom';
import SingularSchema from './singular_schema/SingularSchema'
import CarouselSchema from './carousel_schema/CarouselSchema'
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
                        return <SingularSchema  {...props}/>;                         
                    }
                    else if(page.path == 'misc_schema') {
                        return <MiscSchema  {...props}/>;
                    }                        
                    else if(page.path == 'carousel_schema') {
                        return <CarouselSchema  {...props}/>;
                    }
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