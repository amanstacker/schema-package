/**
 * WordPress dependencies
 */
const {	
	Button,		
	ToggleControl,   
    Modal,    
    TabPanel 
} = wp.components;

const {
	render,	
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
    const [activeTab, setActiveTab] = useState({0: smpg_local.default_language });

    useEffect(() => {
        console.log(activeTab);
    }, [activeTab]);

    
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
      setdataUpdated(prevState => !prevState);     
  }
  const handleSchemaDeleteNo = (i,id) => {
      let copyMeta = [...postMeta];
      copyMeta[i]['is_delete_popup'] = false;
      setPostMeta(copyMeta);        
  }

  const handleRemoveImage = (e, i, j, k, id, elid, tid, repeater, langKey = null) => {
    e.preventDefault();

    let copyMeta = [...postMeta];

    // Determine property key based on language
    const propKey = langKey ? `properties_${langKey}` : 'properties';

    if (repeater) {

        copyMeta[i][propKey][j]['elements'][elid][tid]['value'].splice(k, 1);
        
    } else {        

        copyMeta[i][propKey][j]['value'].splice(k, 1);        

    }

    setPostMeta(copyMeta);
};

  
  const handlePropertyChange = (e, i, j, property_type, multiple, elid, tid, repeater, langKey = null) => {
    let copyMeta = [...postMeta];

    // Determine property key based on language
    const propKey = langKey ? `properties_${langKey}` : 'properties';

    if (property_type === 'media') {

        let image_arr = [];
        let media_uploader = wp.media({
            title: "Schema Image",
            button: { text: "Select Image" },
            multiple: multiple,
            library: { type: 'image' }
        }).on("select", function () {

            media_uploader.state().get('selection').map(function (attachment) {
                attachment.toJSON();
                let image_data = {
                    id: attachment['id'],
                    url: attachment.attributes.sizes.full.url,
                    width: attachment.attributes.sizes.full.width,
                    height: attachment.attributes.sizes.full.height
                };
                image_arr.push(image_data);
            });

            if (repeater) {
                let arrold = copyMeta[i][propKey][j]['elements'][elid][tid]['value'];

                if (multiple) {
                    let merged = [...arrold, ...image_arr];
                    copyMeta[i][propKey][j]['elements'][elid][tid]['value'] = Array.from(new Set(merged.map(JSON.stringify))).map(JSON.parse);
                } else {
                    copyMeta[i][propKey][j]['elements'][elid][tid]['value'] = image_arr;
                }

            } else {
                let arrold = copyMeta[i][propKey][j]['value'];

                if (multiple) {
                    let merged = [...arrold, ...image_arr];
                    copyMeta[i][propKey][j]['value'] = Array.from(new Set(merged.map(JSON.stringify))).map(JSON.parse);
                } else {
                    copyMeta[i][propKey][j]['value'] = image_arr;
                }
            }

            setPostMeta(copyMeta);
        }).open();

    } else {

        if (repeater) {

            if (repeater === 'repeater') {
                let value = copyMeta[i][propKey][j]['elements'][elid][tid]['type'] === 'checkbox' ? e.target.checked : e.target.value;
                copyMeta[i][propKey][j]['elements'][elid][tid]['value'] = value;
            }

            if (repeater === 'groups') {
                let value = copyMeta[i][propKey][j]['elements'][tid]['type'] === 'checkbox' ? e.target.checked : e.target.value;
                copyMeta[i][propKey][j]['elements'][tid]['value'] = value;
            }

        } else {

            if (property_type === 'checkbox') {
                let value = e.target.checked;

                // Special property handling
                if (j === 'speakable') {
                    copyMeta[i][propKey]['speakable_selectors']['display'] = value;
                }
                if (j === 'is_paywalled') {
                    copyMeta[i][propKey]['paywalled_selectors']['display'] = value;
                }
                if (j === 'include_video') {
                    Object.keys(copyMeta[i][propKey]).forEach(key => {
                        const item = copyMeta[i][propKey][key];
                        if (item.type === 'repeater') {
                            item.elements.forEach(el => {
                                Object.keys(el).forEach(ekey => {
                                    if (el[ekey]?.class?.includes('smpg_common_properties')) {
                                        el[ekey].display = value;
                                    }
                                });
                            });
                        } else if (item.class?.includes('smpg_common_properties')) {
                            item.display = value;
                        }
                    });
                }

                copyMeta[i][propKey][j]['value'] = value;

            } else {

                let { value } = e.target;

                if (j === 'offer_type') {
                    if (value === 'AggregateOffer') {
                        copyMeta[i][propKey]['high_price']['display'] = true;
                        copyMeta[i][propKey]['low_price']['display'] = true;
                        copyMeta[i][propKey]['offer_count']['display'] = true;
                        copyMeta[i][propKey]['offer_price']['display'] = false;
                    } else {
                        copyMeta[i][propKey]['high_price']['display'] = false;
                        copyMeta[i][propKey]['low_price']['display'] = false;
                        copyMeta[i][propKey]['offer_count']['display'] = false;
                        copyMeta[i][propKey]['offer_price']['display'] = true;
                    }
                }

                copyMeta[i][propKey][j]['value'] = value;
            }
        }

        setPostMeta(copyMeta);
    }
};

  
  const handleSaveForThePost = ( i ) => {

    let copyMeta = [...postMeta];
        copyMeta[i]['is_setup_popup'] = false;
        setPostMeta(copyMeta);
        setdataUpdated(prevState => !prevState);     
  }

  const savewholeSchemaGeneratorData = () => {

    const body_json          = {};

    body_json.post_id        = smpg_local.post_id;
    body_json.tag_id         = smpg_local.tag_id;
    body_json.user_id        = smpg_local.user_id;
    body_json.post_meta      = postMeta;        
    
    let url = smpg_local.rest_url + 'save-post-meta';
      
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
  
  const handleDeleteRepeater = (e, i, j, elid, langKey = null) => {
    e.preventDefault();

    let copyMeta = [...postMeta];

    // Build language-specific property key
    const propKey = langKey ? `properties_${langKey}` : 'properties';    
    copyMeta[i][propKey][j].elements.splice(elid, 1);    
    setPostMeta(copyMeta);
};


  const handleAddMoreRepeater = (e, i, j, langKey = null) => {
    e.preventDefault();

    let copyMeta = [...postMeta];

    // Use language-specific property key or default
    const propKey = langKey ? `properties_${langKey}` : 'properties';

    if (typeof copyMeta[i][propKey][j]?.elements[0] !== "undefined") {

        let new_element = copyMeta[i][propKey][j].elements[0];
        let fresh_element = [];

        Object.keys(new_element).forEach((key) => {
            let obj = JSON.parse(JSON.stringify(new_element[key]));
            obj['value'] = '';
            fresh_element[key] = obj;
        });

        let new_obj = Object.assign({}, fresh_element);
        copyMeta[i][propKey][j].elements.push(JSON.parse(JSON.stringify(new_obj)));
        setPostMeta(copyMeta);

    } else {

        let url = smpg_local.rest_url + "get-repeater-element" 
            + (smpg_local.rest_url.includes("?") ? "&" : "?") 
            + "schema_id=" + copyMeta[i]['id'] 
            + "&element_name=" + j;

        fetch(url, {
            headers: {
                'X-WP-Nonce': smpg_local.nonce,
            }
        })
        .then(res => res.json())
        .then(
            (result) => {
                if (result.status === 'success' && result.data) {
                    copyMeta[i][propKey][j].elements.push(result.data);
                    setPostMeta(copyMeta);
                }
            },
            (error) => {
                console.error(error);
            }
        );
    }
};


  const getMetaData = ( init ) => {

        setChooseSchemaModal(false);
                
        const body_json          = {};
        
        body_json.selected      = selectedSchema;        
        body_json.post_id       = smpg_local.post_id;
        body_json.tag_id        = smpg_local.tag_id;
        body_json.user_id       = smpg_local.user_id;
        body_json.init          = init;        
        
        let url = smpg_local.rest_url + 'get-selected-schema-properties';
        
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
                if ( ! init ){
                    setdataUpdated(prevState => !prevState);
                }
                
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
        <p className="smpg-description">{__('Include schema types to enhance structured data, enabling rich results in search engine listings.', 'schema-package') }</p>
        </div>
        {(postMeta.length > 0) ?
        <div className="smpg-individual-schema-list">               
        <ul>
            {
                postMeta.map( (item, i) =>{
                    return(
                        <li key={i}>
                            { item.is_setup_popup && (
                                <>
                                {
                                    Object.keys(smpg_local?.language_list ?? {}).length > 0  ? 
                                    // multiple modal when language available
                                   <Modal title={`Edit ${item.text}`}
                                        shouldCloseOnClickOutside={false}
                                        onRequestClose={() => handleCloseModal(i, item.id)}
                                        className="smpg-spg-modal"
                                    >
                                        <div className="smpg-modal-title-wrap">

    <TabPanel
        className="smpg-lang-tabs"
        activeClass="active"
        initialTabName={
            activeTab[i] ?? Object.keys( smpg_local.language_list )[0]
        }
        tabs={
            Object.entries( smpg_local.language_list ).map(
                ([ langKey, langLabel ]) => ({
                    name: langKey,
                    title: __( langLabel, 'schema-package' ),
                })
            )
        }
        onSelect={ ( langKey ) => {
            setActiveTab( ( prev ) => ( {
                ...prev,
                [ i ]: langKey,
            } ) );
        } }
    >
        { () => <></> }
    </TabPanel>
    
</div>


    {/* TAB CONTENTS */}
    {(() => {
    const langs            = smpg_local?.language_list;
    const defaultLanguage  = smpg_local?.default_language;

    if (!langs || typeof langs !== "object") return null;

    const langKeys = Object.keys(langs);
    if (langKeys.length === 0) return null;

    // active tab
    const currentTab = activeTab[i] || langKeys[0];

    // check if current language is default
    const isDefaultLang = currentTab === defaultLanguage;

    // build propKey
    const propKey = isDefaultLang
        ? 'properties'
        : `properties_${currentTab}`;

    // get properties with fallback
    const props =
        item?.[propKey] ??
        item?.properties ??
        {};

    return (
        <div className="smpg-i-schema-setup">
            {Object.entries(props).map(([j, property]) => (
                <div key={j} className="smpg-property-fields">
                    <ElementGenerator
                        i={i}
                        j={j}
                        property={property}
                        langKey={isDefaultLang ? null : currentTab}
                        handlePropertyChange={handlePropertyChange}
                        handleRemoveImage={handleRemoveImage}
                        handleDeleteRepeater={handleDeleteRepeater}
                        handleAddMoreRepeater={handleAddMoreRepeater}
                    />
                </div>
            ))}
        </div>
    );
})()}

    <div className="smpg-spg-modal-footer">
        <Button onClick={() => handleSaveForThePost(i)} isPrimary>
            {__('Save For The Post', 'schema-package')}
        </Button>
    </div>
    
</Modal>

                                    : 
                                    // single modal when language not available
                                    <Modal title={`Edit ${item.text}`} shouldCloseOnClickOutside={false} onRequestClose={ () => handleCloseModal(i, item.id) } className="smpg-spg-modal"  >
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
                                    <div className="smpg-spg-modal-footer">
                                    <Button onClick={() => handleSaveForThePost(i)} isPrimary >
                                        {__('Save For The Post', 'schema-package') }                                        
                                    </Button>
                                    </div>
                                </Modal>
                                }
                                </>                                                                
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
                                <Button 
                                    style={{marginTop:"-10px"}}
                                    onClick={() => handleSchemaEdit(i, item.id)} >
                                    <span className="dashicons dashicons-edit-large"></span>                                        
                                </Button>
                                <Button style={{marginTop:"-10px"}} onClick={() => handleSchemaDelete(i, item.id)} >
                                    <span className="dashicons dashicons-trash"></span>
                                </Button>
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
                <Modal className="smpg-spg-choose-modal" title="Choose Schema Types" shouldCloseOnClickOutside={false} onRequestClose={handleChooseModalClose}>

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

                 <div className="smpg-spg-modal-footer smpg-choose-ok">
                    <Button isPrimary onClick={()=> getMetaData(false)}>{__('Selected', 'schema-package') }</Button>
                </div>

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