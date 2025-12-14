const { __ } = wp.i18n;
const {	Button,	Panel, PanelBody } = wp.components;

import './ElementGenerator.css';

const ElementGenerator = (props) => {
   
  const propertyObj = props.property;
  const langKey = props.langKey;

  const createTypeText = (property, elid, tid, repeater, langKey) => {
    return(                                                                        
        <div className="smpg-form-group">
            <label>{property.label}</label>                                                                            
            <input placeholder={property.placeholder} onChange={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater, langKey)} type="text" className="smpg-form-control" value={property.value} />                                                                            
            <p className="smpg-description">{property.tooltip}</p>
        </div>                                                                                                                                                
    );
  }
  
  const createTypeMedia = (property, elid, tid, repeater, langKey) => {
    return(                                                                        
        <div className="smpg-form-group">
            <label>{property.label}</label><br/>
            { (property.value.length > 0) ? 
            <div className="smpg-media-upload">                                                                                
                <div className="smpg-list-grid">
                {property.value.map((img, k) => {
                    return(                                                                                            
                            <div key={k} className="smpg-image-preview">
                                <img src={img.url} /><a href="#" onClick={(e)=>props.handleRemoveImage(e, props.i, props.j, k, img.id, elid, tid, repeater, langKey )}>X</a>
                            </div>                                                                                            
                        );
                })}                                                                                
            </div>   
            </div>                       
            : ''}                                              
                                                                                            
        <Button className="smpg-upload-img-btn" onClick={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, property.multiple, elid, tid, repeater, langKey)} isSecondary>{`Upload ${property.label}`}</Button>
        <p className="smpg-description">{property.tooltip}</p>
        </div>                                                                                                                                                
    );
  }

  const createTypeCheckbox = (property, elid, tid, repeater, langKey) => {
    return(                                                                        
        <div className="smpg-form-group">
                        <label>{property.label}</label><br/>                                                                            
                        <input onChange={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater, langKey)} type="checkbox" className="smpg-form-control" checked={property.value} />                                                                            
                        <p className="smpg-description">{property.tooltip}</p>
        </div>                                                                                                                                                
    );
  }

  const createTypeNumber = (property, elid, tid, repeater, langKey) => {
    return(                                                                        
        <div className="smpg-form-group">
                        <label>{property.label}</label>                                                                            
                        <input placeholder={property.placeholder} onChange={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater, langKey)} type="number" className="smpg-form-control" value={property.value} step="any" />                                                                            
                        <p className="smpg-description">{property.tooltip}</p>
        </div>                                                                                                                                                
    );
  }

  const createTypeTextarea = (property, elid, tid, repeater, langKey) => {
    return(                                                                        
        <div className="smpg-form-group">
            <label>{property.label}</label>                                                                            
            <textarea placeholder={property.placeholder} className="smpg-form-control" onChange={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater, langKey)} rows="4" value={property.value}  />                                                                            
            <p className="smpg-description">{property.tooltip}</p>
        </div>                                                                                                                                                
    );
  }
  const createTypeEditor = (property, elid, tid, repeater, langKey) => {
    return(
        <div className="smpg-form-group">
            <label>{property.label}</label>                                                                            
            <textarea placeholder={property.placeholder} className="smpg-form-control" onChange={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater, langKey)} rows="10" value={property.value}  />                                                                            
            <p className="smpg-description">{property.tooltip}</p>
        </div>                                                                                                                                                
    );
  }

  const createTypeSelect = (property, elid, tid, repeater, langKey) => {
    return(                                                                        
        <div className="smpg-form-group">
            <label>{property.label}</label>                                                                            
            <select className="smpg-form-control" onChange={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater, langKey)} value={property.value}>
            {
                Object.entries(property.options).map(([key, value]) => {
                    return(<option value={key}>{value}</option>)
                })                                                                                
            }
            </select>                      
            <p className="smpg-description">{property.tooltip}</p>                                                     
        </div>                                                                                                                                                
    );
  }
  
  return (
    <>    
    {(() => {
       if(propertyObj.display){
        let rcount = 0;
        switch (propertyObj.type) {

            case 'groups':
                 
                return(
                    <>
                    <h3>{propertyObj.label}</h3>
                    <div className='smpg-groups-elements'>
                    {Object.entries(propertyObj.elements).map(([tid, tags]) => {
                        
                    if(tags.display){

                        switch (tags.type) {

                            case 'number':
                                return(
                                    createTypeNumber(tags, null, tid, 'groups', langKey)
                                );                                

                            case 'textarea':
                                return(
                                    createTypeTextarea(tags, null, tid, 'groups', langKey)
                                );                                

                            case 'media':
                                return(
                                    createTypeMedia(tags, null, tid, 'groups', langKey)
                                );                                    

                            case 'select':
                                return(
                                    createTypeSelect(tags, null, tid, 'groups', langKey)
                                ); 
                            case 'checkbox':
                                return(
                                    createTypeCheckbox(tags, null, tid, 'groups', langKey)
                                );                                         
                        
                            default:
                                return(
                                    createTypeText(tags, null, tid, 'groups', langKey)
                                );                                                                
                        }
                    }

                    }                        
                    )}                                                
                    </div>
                    </>
                );

             case 'repeater':
                 
                return(
                    <>                    
                    <Panel className="smpg-repeater-panel"> 
                    <PanelBody title={propertyObj.label} initialOpen={ true }>
                    {
                     (propertyObj.elements.length > 0) ?  
                     propertyObj.elements.map((element, elid) => {
                        rcount++;
                        return(
                            <div className="smpg-repeater-panel-body">
                                <span className="smpg-repeater-i">{rcount}</span>
                                <span onClick={(e) => props.handleDeleteRepeater(e, props.i, props.j, elid, langKey)} className="dashicons dashicons-trash smpg-trash-repeater"></span>
                                {

                                    Object.entries(element).map(([tid, tags]) => {

                                        if(tags.display){

                                            switch (tags.type) {

                                                case 'number':
                                                    return(
                                                        createTypeNumber(tags, elid, tid, 'repeater', langKey)
                                                    );                                
                    
                                                case 'textarea':
                                                    return(
                                                        createTypeTextarea(tags, elid, tid, 'repeater', langKey)
                                                    );                                
                    
                                                case 'media':
                                                    return(
                                                        createTypeMedia(tags, elid, tid, 'repeater', langKey)
                                                    );                                    
                    
                                                case 'select':
                                                    return(
                                                        createTypeSelect(tags, elid, tid, 'repeater', langKey)
                                                    ); 
                                                case 'checkbox':
                                                    return(
                                                        createTypeCheckbox(tags, elid, tid, 'repeater', langKey)
                                                    );                                         
                                            
                                                default:
                                                    return(
                                                        createTypeText(tags, elid, tid, 'repeater', langKey)
                                                    );                                                                
                                            }
                                        }
                                    })                                    
                                }
                            </div>
                        )
                        
                        
                    })                    
                     : ''
                    } 
                    <div><Button onClick={(e)=>props.handleAddMoreRepeater(e, props.i, props.j, langKey)} isSecondary>{propertyObj.button_text}</Button></div> 
                    </PanelBody>                   
                    </Panel>                                      
                    </>
                );

            case 'select':
                return(
                    createTypeSelect(propertyObj, null, null, null, langKey)
                )                
            case 'textarea':
                return(
                    createTypeTextarea(propertyObj, null, null, null, langKey)
                )
            case 'editor':
                return(
                    createTypeEditor(propertyObj, null, null, null, langKey)
                )
            case 'media':
                return(
                    createTypeMedia(propertyObj, null, null, null, langKey)
                )                                                                        
            case 'number':
                return(
                    createTypeNumber(propertyObj, null, null, null, langKey)
                )
            case 'checkbox':
                return(
                    createTypeCheckbox(propertyObj, null, null, null, langKey)
                )                    
            default:
                return(
                    createTypeText(propertyObj, null, null, null, langKey)
                )                                                
        }
       }     
    })()}
    </>
  );

}

export default ElementGenerator;