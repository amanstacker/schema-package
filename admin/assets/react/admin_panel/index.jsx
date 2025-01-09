import React from 'react';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import ReactDOM from "react-dom";
import queryString from 'query-string'
import ListPage from './ListPage'
import SingularSchemaEdit from './SingularSchemaEdit'
import CarouselSchemaEdit from './CarouselSchemaEdit'
import './style/common.css'


const SMPGRootComponent = () => {

    return (
        <Router>                                                                            
                <Switch>
                    <Route render={props => {                                        
                        const page = queryString.parse(window.location.search); 
                                                           
                            if(typeof(page.path)  == 'undefined' || page.path == 'carousel_schema' || page.path == 'misc_schema' ||page.path == 'archive_schema' || page.path.includes('settings')) {                           
                                return <ListPage  {...props}/>;                         
                            }                        
                            else if(page.path == 'singular_schema_edit') {                                        
                                return <SingularSchemaEdit  {...props}/>;
                            }
                            else if(page.path == 'carousel_schema_edit') {
                                return <CarouselSchemaEdit  {...props}/>;
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