/**
 * WordPress dependencies
 */
const { subscribe, select } = wp.data;

const {
	BaseControl,
	Button,
	ExternalLink,
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
    useEffect,
    useRef
} = wp.element;

/**
 * Internal dependencies
 */
 import './style/common.css'

 import { schemaTypes } from '../shared/schemaTypes';
 import ElementGenerator from '../shared/ElementGenerator/ElementGenerator';

 const Metabox = () => {

    const {__} = wp.i18n; 
    const hasPageBeenRenderd = useRef({effect:false});
    const [postMeta, setPostMeta] = useState([]);
    const [chooseSchemaModal, setChooseSchemaModal] = useState(false);
    const [selectedSchema, setSelectedSchema]       = useState([]);
    const [dataUpdated, setdataUpdated]             = useState(false);
    
    const handleSchemaTurnOnOff = (i,id) => {
        let copyMeta = [...postMeta];
        copyMeta[i]['is_enable'] = !copyMeta[i]['is_enable'];
        setPostMeta(copyMeta);            
        setdataUpdated(prevState => !prevState);
  
  }

  const handleSchemaEdit = (i,id) => {
    let copyMeta = [...postMeta];
        copyMeta[i]['is_setup_popup'] = !copyMeta[i]['is_setup_popup'];
        setPostMeta(copyMeta);            
  }

  const handleCloseModal = (i,id) => {
      let copyMeta = [...postMeta];
        copyMeta[i]['is_setup_popup'] = false;
        setPostMeta(copyMeta);        
  }

  const handleSchemaDelete = (i,id) => {
      let copyMeta = [...postMeta];
      copyMeta[i]['is_delete_popup'] = !copyMeta[i]['is_delete_popup'];
      setPostMeta(copyMeta);        
  }

  const handleSchemaDeleteYes = (i,id) => {
      let copyMeta = [...postMeta];    
      copyMeta.splice(i, 1);      
      setPostMeta(copyMeta);  
      setdataUpdated(true);        
  }
  const handleSchemaDeleteNo = (i,id) => {
      let copyMeta = [...postMeta];
      copyMeta[i]['is_delete_popup'] = false;
      setPostMeta(copyMeta);        
  }

  const handleRemoveImage = (e, i, j, k, id, elid, tid, repeater) => {

    e.preventDefault()

    let copyMeta = [...postMeta];

    if(repeater){
        copyMeta[i]['properties'][j]['elements'][elid][tid]['value'].splice(k,1);                    
    }else{            
        copyMeta[i]['properties'][j]['value'].splice(k,1);                
    }

    setPostMeta(copyMeta);        
    
  }
  
  const handlePropertyChange = (e, i, j, property_type, multiple, elid, tid, repeater ) =>{
    
    let copyMeta = [...postMeta];

    if(property_type == 'media'){

        let image_arr = [];
        let media_uploader = wp.media({
            title: "Schema Image",
            button: {
              text: "Select Image"
            },
            multiple: multiple,  
            library:{type : 'image'}
          }).on("select", function() {

             media_uploader.state().get('selection').map( 

                function( attachment ) {

                    attachment.toJSON();

                    let image_data = {};
                        image_data.id        = attachment['id'];
                        image_data.url       = attachment.attributes.sizes.full.url;                
                        image_data.width     = attachment.attributes.sizes.full.width;
                        image_data.height    = attachment.attributes.sizes.full.height;
                        image_arr.push(image_data);                                                     
               });   


               if(repeater){

                     let arrold = copyMeta[i]['properties'][j]['elements'][elid][tid]['value'];

                    if(multiple){               
                        let merged = [...arrold, ...image_arr];
                        copyMeta[i]['properties'][j]['elements'][elid][tid]['value'] = Array.from(new Set(merged.map(JSON.stringify))).map(JSON.parse);    
                    }else{
                        copyMeta[i]['properties'][j]['elements'][elid][tid]['value'] = image_arr;
                    }
                    setPostMeta(copyMeta);   

               }else{

                    let arrold = copyMeta[i]['properties'][j]['value'];

                    if(multiple){               
                    let merged = [...arrold, ...image_arr];
                    copyMeta[i]['properties'][j]['value'] = Array.from(new Set(merged.map(JSON.stringify))).map(JSON.parse);    
                    }else{
                    copyMeta[i]['properties'][j]['value'] = image_arr;
                    }
                    setPostMeta(copyMeta);   

               }                              
               
          }).open();
          
    }else{     
        
      if(repeater){
            
        let value;

        if(copyMeta[i]['properties'][j]['elements'][elid][tid]['type'] == 'checkbox'){
            value = e.target.checked;
        }else{
            value = e.target.value;                
        }
        
        copyMeta[i]['properties'][j]['elements'][elid][tid]['value'] = value;              
        setPostMeta(copyMeta);  
        
      }else{

        if(property_type == 'checkbox'){

          let value = e.target.checked;
            
          if( j == 'speakable' ){

            if(value){
                copyMeta[i]['properties']['speakable_selectors']['display'] = true;
            }else{
                copyMeta[i]['properties']['speakable_selectors']['display'] = false;
            }
            
          }

          if( j == 'is_paywalled'){

            if(value){
                copyMeta[i]['properties']['paywalled_selectors']['display'] = true;
            }else{
                copyMeta[i]['properties']['paywalled_selectors']['display'] = false;
            }
            
          }

          if( j == 'include_video'){
                        
            Object.keys(copyMeta[i]['properties']).forEach(function (key) {

                if(copyMeta[i]['properties'][key]['type'] == 'repeater'){

                    copyMeta[i]['properties'][key]['elements'].map( (item, o) => {
                        
                        Object.keys(item).forEach(function (ekey) {

                            if(typeof item[ekey]['class'] !== "undefined"){

                                if(item[ekey]['class'].includes('smpg_common_properties')){
                                    if(value){
                                        item[ekey]['display'] = true;                                        
                                    }else{
                                        item[ekey]['display'] = false;
                                    }
                                }

                            }

                        }) 
                                                   
                    })

                }else{

                    if(typeof copyMeta[i]['properties'][key]['class'] !== "undefined"){

                        if(copyMeta[i]['properties'][key]['class'].includes('smpg_common_properties')){
                        
                            if(value){
                                copyMeta[i]['properties'][key]['display'] = true;
                            }else{
                                copyMeta[i]['properties'][key]['display'] = false;
                            }
        
                        }
                    }

                }
                                                                         
            });
                        
          }

          copyMeta[i]['properties'][j]['value'] = value;   
          
          setPostMeta(copyMeta);    

        }else if( property_type == 'multiselect' ){
            let value = Array.from(e.target.selectedOptions, (item) => item.value);
            copyMeta[i]['properties'][j]['value'] = value;      
            setPostMeta(copyMeta);    

        }else{

            let {value} = e.target;

            if(j == 'offer_type'){

                if(value == 'AggregateOffer'){
                    copyMeta[i]['properties']['high_price']['display']  = true;
                    copyMeta[i]['properties']['low_price']['display']   = true;
                    copyMeta[i]['properties']['offer_count']['display'] = true;
                    copyMeta[i]['properties']['offer_price']['display'] = false;
                }else{
                    copyMeta[i]['properties']['high_price']['display']  = false;
                    copyMeta[i]['properties']['low_price']['display']   = false;
                    copyMeta[i]['properties']['offer_count']['display'] = false;
                    copyMeta[i]['properties']['offer_price']['display'] = true;
                }
                                
            }

            copyMeta[i]['properties'][j]['value'] = value;      
            setPostMeta(copyMeta);    
            
        }
                              
      }  
            
    }    
    
  }
  
  const handleSaveForThePost = ( i ) => {

    let copyMeta = [...postMeta];
        copyMeta[i]['is_setup_popup'] = false;
        setPostMeta(copyMeta);
        setdataUpdated(true);        
  }

  const savewholeSchemaGeneratorData = () => {

    const body_json          = {};

    body_json.post_id        = smpg_local.post_id;
    body_json.tag_id         = smpg_local.tag_id;
    body_json.post_meta      = postMeta;        
    
    let url = smpg_local.rest_url + 'smpg-route/save-post-meta';
      
    fetch(url,{
      method: "post",
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-WP-Nonce': smpg_local.nonce,
      },
      body: JSON.stringify(body_json)
    })
    .then(res => res.json())
    .then(
      (result) => {
        
      },        
      (error) => {
        
      }
    );

  }
      
  const handleChooseModalOpen = () => {
    setChooseSchemaModal(true);    
  }

  const handleChooseModalClose = () => {
    setChooseSchemaModal(false);
    setSelectedSchema([]);
  }

  const handleChooseSchemaTypes = (id) =>{

        let copydata = [...selectedSchema];        
        let index = copydata.indexOf(id);

        if(index !== -1){  
            copydata.splice(index, 1); 
        }else{
            copydata.push(id);
        }
        setSelectedSchema(copydata);
  }
  
  const handleDeleteRepeater = (e, i, j, elid) => {

    let copyMeta = [...postMeta];    
     copyMeta[i]['properties'][j]['elements'].splice(elid, 1); 
     setPostMeta(copyMeta);    

  }

  const handleAddMoreRepeater = (e, i, j) => {

    let copyMeta    = [...postMeta];    

    if (typeof copyMeta[i]['properties'][j]['elements'][0] !== "undefined") {

        let new_element   = copyMeta[i]['properties'][j]['elements'][0];
        let fresh_element = [];
        
        Object.keys(new_element).forEach(function (key) {
            let obj = JSON.parse(JSON.stringify(new_element[key]));
            obj['value'] = '';
            fresh_element[key] = obj;            
        });

        let new_obj = Object.assign({}, fresh_element);                         
        copyMeta[i]['properties'][j]['elements'].push(JSON.parse(JSON.stringify(new_obj)));
        setPostMeta(copyMeta);    

    }else{
        
        let url = smpg_local.rest_url + "smpg-route/get-repeater-element?schema_id="+ copyMeta[i]['id'] + "&element_name=" + j ;
        
        fetch(url, {
        headers: {                    
            'X-WP-Nonce': smpg_local.nonce,
        }
        })
        .then(res => res.json())
        .then(
        (result) => {         
    
           if(result.status == 'success' && result.data){
            copyMeta[i]['properties'][j]['elements'].push(result.data);
            setPostMeta(copyMeta);  
           }
                                                                        
        },        
        (error) => {
        
        }
        );  

    } 
    
  }

  const getMetaData = ( init ) => {

        setChooseSchemaModal(false);
                
        const body_json          = {};
        
        body_json.selected      = selectedSchema;        
        body_json.post_id       = smpg_local.post_id;
        body_json.tag_id        = smpg_local.tag_id;
        body_json.init          = init;        
        
        let url = smpg_local.rest_url + 'smpg-route/get-selected-schema-properties';
        
        fetch(url,{
        method: "post",
        headers: {    
            'Accept': 'application/json',
            'Content-Type': 'application/json',    
            'X-WP-Nonce': smpg_local.nonce,
        },
        body: JSON.stringify(body_json)
        })
        .then(res => res.json())
        .then(
        (result) => {
            
            if(result.status == 'success'){

                let copyMeta = [...postMeta];                
                
                Object.entries(result['properties']).map(([key, value]) => {
                    copyMeta.push(value);
                });
                setPostMeta(copyMeta);        
            }            
                
        },        
        (error) => {
            
        }
        );
        setSelectedSchema([]);    
    
  }

  useEffect(() => {
    getMetaData(true);    
  },[]);

  useEffect(() => {

    if(hasPageBeenRenderd.current["effect"]){
        savewholeSchemaGeneratorData();  
    }

    hasPageBeenRenderd.current["effect"] = true;
    
  },[dataUpdated]);
 
    return (
        <>                    
        <div>
            <p className="smpg-description">{__('Add schema types. Structured Data is used to display rich results in SERPs.', 'schema-package') } 
                {/* <a>{__('Learn More.', 'schema-package') }</a> */}
            </p>
        </div>
        {(postMeta.length > 0) ?
        <div className="smpg-individual-schema-list">
        <div><h4>{__('Schema List', 'schema-package') }</h4></div>        
        <ul>
            {
                postMeta.map( (item, i) =>{
                    return(
                        <li key={i}>
                            { item.is_setup_popup && (
                                <Modal title={`Edit ${item.text}`} shouldCloseOnClickOutside={false} onRequestClose={ () => handleCloseModal(i, item.id) }>
                                    <div className="smpg-i-schema-setup">
                                        {
                                            Object.entries(item.properties).map(([j, property]) => {                                            
                                                return(                                                    
                                                    <div key={j} className="smpg-property-fields">
                                                     <ElementGenerator 
                                                        i = {i}
                                                        j = {j}
                                                        property={property} 
                                                        handlePropertyChange ={handlePropertyChange}
                                                        handleRemoveImage = {handleRemoveImage}
                                                        handleDeleteRepeater = {handleDeleteRepeater}
                                                        handleAddMoreRepeater = {handleAddMoreRepeater}
                                                        />   
                                                    </div>
                                                );
                                            })
                                        }
                                    </div>
                                    <Button onClick={() => handleSaveForThePost(i)} isPrimary >
                                        {__('Save For The Post', 'schema-package') }                                        
                                    </Button>
                                </Modal>
                            ) }

                            {item.has_warning ? <span className="dashicons dashicons-warning smpg-i-warning-icon"></span> : ''}                
                            
                            <strong>{item.text}</strong> 

                            <span className="smpg-individual-item-actions">
                                {
                                    item.is_delete_popup ? 
                                        <div className="smpg-delete-popover">
                                            <span>{__('Delete ?', 'schema-package') } </span>
                                            <Button isLink onClick={() => handleSchemaDeleteYes(i, item.id)}>{__('Yes', 'schema-package') }</Button> : <Button isLink onClick={() => handleSchemaDeleteNo(i, item.id)} >{__('No', 'schema-package') }</Button>
                                        </div>
                                    : ''
                                }                                
                                <ToggleControl                                 
                                    checked={item.is_enable}
                                    onChange={() => handleSchemaTurnOnOff(i, item.id)}
                                />
                                <Button onClick={() => handleSchemaEdit(i, item.id)} ><span className="dashicons dashicons-edit-large"></span></Button>
                                <Button onClick={() => handleSchemaDelete(i, item.id)} ><span className="dashicons dashicons-trash"></span></Button>
                            </span>
                        </li>         
                    )
                })
            }
         
        </ul>
    </div>
        : null}
        <div className="smpg-add-schema-action">        
            <div className="smpg-add-schema-select">    
            {
                chooseSchemaModal ? 
                <Modal title="Choose Schema Types" shouldCloseOnClickOutside={false} onRequestClose={handleChooseModalClose}>

                 <div className="smpg-schema-list">
                        <div className="smpg-list-grid">
                            {
                                schemaTypes ? schemaTypes.map((schema, l)=>{
                                    return(
                                        <div key={l} className={`smpg-item-box ${ selectedSchema.includes(schema.value) ? 'smpg-item-box-selected' : '' }`} onClick={()=>handleChooseSchemaTypes(schema.value)}><strong>{schema.text}</strong></div>
                                    )
                                })     : ''
                            }                                                    
                        </div>   
                 </div>  

                 <div className="smpg-choose-ok"><Button isPrimary onClick={()=> getMetaData(false)}>{__('Selected', 'schema-package') }</Button></div>

                </Modal>: ''
            }
            
                <div><Button onClick={handleChooseModalOpen} isPrimary>{__('Choose Schema Types', 'schema-package') }</Button></div>    
            </div>                                            
        </div>
        </>             
    );
    
 }

 render(
	<Metabox/>,
	document.getElementById( 'smpg_individual_post_container' )
);