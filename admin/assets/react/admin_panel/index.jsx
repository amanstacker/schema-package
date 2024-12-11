import React from 'react';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import ReactDOM from "react-dom";
import queryString from 'query-string'
import ListPage from './ListPage'
import SinglePage from './SinglePage'
import ArchivePage from './ArchivePage'
import './style/common.css'


const SMPGRootComponent = () => {

    return (
        <Router>                                                                            
                <Switch>
                    <Route render={props => {                                        
                        const page = queryString.parse(window.location.search); 
                                                           
                            if(typeof(page.path)  == 'undefined' || page.path == 'misc_schema' ||page.path == 'archive_schema' || page.path.includes('settings')) {                           
                                return <ListPage  {...props}/>;                         
                            }                        
                            else if(page.path == 'single_page') {                                        
                                return <SinglePage  {...props}/>;
                            }
                            else if(page.path == 'archive_page') {
                                return <ArchivePage  {...props}/>;
                            }
                            else{
                                return null;
                            }                    
                        }}/>            
            </Switch>               
           </Router>                             
    );

}

ReactDOM.render(<SMPGRootComponent />, document.getElementById('smpg-entry-div'));