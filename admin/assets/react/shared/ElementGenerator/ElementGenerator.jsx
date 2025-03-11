const { __ } = wp.i18n;
const {
	BaseControl,
	Button,
	ExternalLink,
    Panel,
	PanelBody,
	PanelRow,
	Placeholder,
	Spinner,
	ToggleControl,
    SelectControl,
    Modal,
    ComboboxControl,
    Tooltip
} = wp.components;

const {
	render,
	Component,
	Fragment,
    useState,
    useEffect  
} = wp.element;

import './ElementGenerator.css';

const ElementGenerator = (props) => {
   
  const propertyObj = props.property;

  const createTypeText = (property, elid, tid, repeater) => {
    return(                                                                        
        <div className="smpg-form-group">
            <label>{property.label}</label>                                                                            
            <input placeholder={property.placeholder} onChange={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater)} type="text" className="smpg-form-control" value={property.value} />                                                                            
            <p className="smpg-description">{property.tooltip}</p>
        </div>                                                                                                                                                
    );
  }
  
  const createTypeMedia = (property, elid, tid, repeater) => {
    return(                                                                        
        <div className="smpg-form-group">
            <label>{property.label}</label><br/>
            { (property.value.length > 0) ? 
            <div className="smpg-media-upload">                                                                                
                <div className="smpg-list-grid">
                {property.value.map((img, k) => {
                    return(                                                                                            
                            <div key={k} className="smpg-image-preview">
                                <img src={img.url} /><a href="#" onClick={(e)=>props.handleRemoveImage(e, props.i, props.j, k, img.id, elid, tid, repeater )}>X</a>
                            </div>                                                                                            
                        );
                })}                                                                                
            </div>   
            </div>                       
            : ''}                                              
                                                                                            
        <Button className="smpg-upload-img-btn" onClick={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, property.multiple, elid, tid, repeater)} isSecondary>{`Upload ${property.label}`}</Button>
        <p className="smpg-description">{property.tooltip}</p>
        </div>                                                                                                                                                
    );
  }

  const createTypeCheckbox = (property, elid, tid, repeater) => {
    return(                                                                        
        <div className="smpg-form-group">
                        <label>{property.label}</label><br/>                                                                            
                        <input onChange={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater)} type="checkbox" className="smpg-form-control" checked={property.value} />                                                                            
                        <p className="smpg-description">{property.tooltip}</p>
        </div>                                                                                                                                                
    );
  }

  const createTypeNumber = (property, elid, tid, repeater) => {
    return(                                                                        
        <div className="smpg-form-group">
                        <label>{property.label}</label>                                                                            
                        <input placeholder={property.placeholder} onChange={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater)} type="number" className="smpg-form-control" value={property.value} />                                                                            
                        <p className="smpg-description">{property.tooltip}</p>
        </div>                                                                                                                                                
    );
  }

  const createTypeTextarea = (property, elid, tid, repeater) => {
    return(                                                                        
        <div className="smpg-form-group">
            <label>{property.label}</label>                                                                            
            <textarea placeholder={property.placeholder} className="smpg-form-control" onChange={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater)} rows="4" value={property.value}  />                                                                            
            <p className="smpg-description">{property.tooltip}</p>
        </div>                                                                                                                                                
    );
  }
  const createTypeEditor = (property, elid, tid, repeater) => {
    return(                                                                        
        <div className="smpg-form-group">
            <label>{property.label}</label>                                                                            
            <textarea placeholder={property.placeholder} className="smpg-form-control" onChange={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater)} rows="10" value={property.value}  />                                                                            
            <p className="smpg-description">{property.tooltip}</p>
        </div>                                                                                                                                                
    );
  }

  const createTypeSelect = (property, elid, tid, repeater) => {
    return(                                                                        
        <div className="smpg-form-group">
            <label>{property.label}</label>                                                                            
            <select className="smpg-form-control" onChange={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater)} value={property.value}>
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

  const createTypeMultiSelect = (property, elid, tid, repeater) => {
    return(                                                                        
        <div className="smpg-form-group">
            <label>{property.label}</label>                                                                            
            <select multiple={true} className="smpg-form-control" onChange={(e)=>props.handlePropertyChange(e, props.i, props.j, property.type, null, elid, tid, repeater)} value={property.value}>
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
                                <span onClick={(e) => props.handleDeleteRepeater(e, props.i, props.j, elid)} className="dashicons dashicons-trash smpg-trash-repeater"></span>
                                {

                                    Object.entries(element).map(([tid, tags]) => {

                                        if(tags.display){

                                            switch (tags.type) {

                                                case 'number':
                                                    return(
                                                        createTypeNumber(tags, elid, tid, 'repeater')
                                                    );                                
                    
                                                case 'textarea':
                                                    return(
                                                        createTypeTextarea(tags, elid, tid, 'repeater')
                                                    );                                
                    
                                                case 'media':
                                                    return(
                                                        createTypeMedia(tags, elid, tid, 'repeater')
                                                    );                                    
                    
                                                case 'select':
                                                    return(
                                                        createTypeSelect(tags, elid, tid, 'repeater')
                                                    ); 
                                                case 'checkbox':
                                                    return(
                                                        createTypeCheckbox(tags, elid, tid, 'repeater')
                                                    );                                         
                                            
                                                default:
                                                    return(
                                                        createTypeText(tags, elid, tid, 'repeater')
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
                    <div><Button onClick={(e)=>props.handleAddMoreRepeater(e, props.i, props.j)} isSecondary>{propertyObj.button_text}</Button></div> 
                    </PanelBody>                   
                    </Panel>                                      
                    </>
                );

            case 'select':
                return(
                    createTypeSelect(propertyObj, null, null, null)
                )
            case 'multiselect':
                return(
                    createTypeMultiSelect(propertyObj, null, null, null)
                )    

            case 'textarea':
                return(
                    createTypeTextarea(propertyObj, null, null, null)
                )
            case 'editor':
                return(
                    createTypeEditor(propertyObj, null, null, null)
                )
            case 'media':
                return(
                    createTypeMedia(propertyObj, null, null, null)
                )                                                                        
            case 'number':
                return(
                    createTypeNumber(propertyObj, null, null, null)
                )
            case 'checkbox':
                return(
                    createTypeCheckbox(propertyObj, null, null, null)
                )                    
            default:
                return(
                    createTypeText(propertyObj, null, null, null)
                )                                                
        }
       }     
    })()}
    </>
  );

}

export default ElementGenerator;