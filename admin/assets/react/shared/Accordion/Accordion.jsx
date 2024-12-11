
import React, { useState } from 'react';
import './Accordion.css';
 
const Accordion = ({ children, title, isExpand = false }) => {

  const [expand, setExpand] = useState(isExpand);

  return (
    <div className="smpg-segment ui segment">
        <a class="smpg-accordion" onClick={() => setExpand(expand => !expand) }><h4>{title}</h4></a>              
        <i className={`dropdown icon smpg-icon ${!expand ? ' smpg-left-arrow' : ''}`}></i>
        <div className="smpg-clearfix"></div>      
      {expand && <div className="smpg-accordion-panel">{children}</div>}
    </div>
  )
}

export default Accordion;