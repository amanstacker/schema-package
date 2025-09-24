import React, { useState, useEffect } from "react";
import { Grid, Label, Header, Segment, Dropdown, Divider, TextArea, Button, Image } from "semantic-ui-react";

const SchemaMapping = ({ schemaProperties, mappedPropertiesKey, mappedPropertiesValue, handleMappedPropertiesValue }) => {
  const { __ } = wp.i18n;

  const [wpMetaList, setWpMetaList] = useState([]);
  const [customFieldsList, setCustomFieldsList] = useState([]);
  const [advancedCustomFieldsList, setAdvancedCustomFieldsList] = useState([]);
  const [taxonomyList, setTaxonomyList] = useState([]);
  const [selectedMetaFields, setSelectedMetaFields] = useState(mappedPropertiesValue);
  const [customFieldSearch, setCustomFieldSearch] = useState("");
  const [advancedCustomFieldSearch, setAdvancedCustomFieldSearch] = useState("");

  useEffect(() => {
    const fetchMetaFields = async () => {
      try {
        const url = smpg_local.rest_url + "get-mapping-meta-list";
        const response = await fetch(url, {
          headers: { "X-WP-Nonce": smpg_local.nonce },
        });
        const data = await response.json();
        setWpMetaList(data);
      } catch (error) {
        console.error("Error fetching meta fields:", error);
      }
    };

    fetchMetaFields();
  }, []);

  useEffect(() => {
    const fetchCustomFields = async () => {
      try {
        const url = smpg_local.rest_url + "get-custom-fields" + (smpg_local.rest_url.includes("?") ? "&" : "?") + "search=" + encodeURIComponent(customFieldSearch);
        const response = await fetch(url, {
          headers: { "X-WP-Nonce": smpg_local.nonce },
        });
        const data = await response.json();
  
        // Format fetched fields
        const fetchedFields = data.map((field) => ({
          key: field.id,
          value: field.value,
          text: field.label,
        }));
  
        setCustomFieldsList((prevList) => {
          // Get already selected custom fields
          const selectedFields = Object.values(selectedMetaFields)
            .filter((meta) => meta.custom_field)
            .map((meta) => ({
              key: meta.custom_field,
              value: meta.custom_field,
              text: meta.custom_field, // Ensure the label is appropriate
            }));
  
          // Merge with previous list to keep stability during navigation
          const mergedFields = [...selectedFields, ...prevList, ...fetchedFields].filter(
            (field, index, self) => index === self.findIndex((f) => f.value === field.value) // Remove duplicates
          );
  
          return mergedFields;
        });
      } catch (error) {
        console.error("Error fetching custom fields:", error);
      }
    };
  
    fetchCustomFields();
  }, [customFieldSearch]);

  useEffect(() => {
    const fetchAdvancedCustomFields = async () => {
      try {
        const url = smpg_local.rest_url + "get-advanced-custom-fields" + (smpg_local.rest_url.includes("?") ? "&" : "?") + "search=" + encodeURIComponent(advancedCustomFieldSearch);
        const response = await fetch(url, {
          headers: { "X-WP-Nonce": smpg_local.nonce },
        });
        const data = await response.json();
  
        // Format fetched fields
        const fetchedFields = data.map((field) => ({
          key: field.id,
          value: field.value,
          text: field.label,
        }));
  
        setAdvancedCustomFieldsList((prevList) => {
          // Get already selected custom fields
          const selectedFields = Object.values(selectedMetaFields)
            .filter((meta) => meta.advanced_custom_field)
            .map((meta) => ({
              key: meta.advanced_custom_field,
              value: meta.advanced_custom_field,
              text: meta.advanced_custom_field, // Ensure the label is appropriate
            }));
  
          // Merge with previous list to keep stability during navigation
          const mergedFields = [...selectedFields, ...prevList, ...fetchedFields].filter(
            (field, index, self) => index === self.findIndex((f) => f.value === field.value) // Remove duplicates
          );
  
          return mergedFields;
        });
      } catch (error) {
        console.error("Error fetching advanced custom fields:", error);
      }
    };
  
    fetchAdvancedCustomFields();
  }, [advancedCustomFieldSearch]);
  
  

  useEffect(() => {
    const fetchTaxonomyValues = async () => {
      try {
        const url = smpg_local.rest_url + "get-taxonomies";
        const response = await fetch(url, {
          headers: { "X-WP-Nonce": smpg_local.nonce },
        });
        const data = await response.json();

        const formattedTaxonomies = data.map((tax) => ({
          key: tax.slug,
          value: tax.slug,
          text: tax.name,
        }));

        setTaxonomyList(formattedTaxonomies);
      } catch (error) {
        console.error("Error fetching taxonomies:", error);
      }
    };

    fetchTaxonomyValues();
  }, []);

  const handleMetaFieldChange = (schemaKey, value) => {
    setSelectedMetaFields((prev) => ({
      ...prev,
      [schemaKey]: { meta_field: value },
    }));
  };

  const handleCustomFieldChange = (schemaKey, type, value) => {
    setSelectedMetaFields((prev) => ({
      ...prev,
      [schemaKey]: {
        meta_field: prev[schemaKey]?.meta_field,
        custom_text: type === "custom_text" ? value : prev[schemaKey]?.custom_text || "",
        taxonomy: type === "taxonomy" ? value : prev[schemaKey]?.taxonomy || "",
        custom_field: type === "custom_field" ? value : prev[schemaKey]?.custom_field || "",
        advanced_custom_field: type === "advanced_custom_field" ? value : prev[schemaKey]?.advanced_custom_field || "",
        custom_image: type === "custom_image" ? value : prev[schemaKey]?.custom_image || "",
      },
    }));
  };

  // Open WordPress Media Uploader
  const openMediaUploader = (schemaKey) => {
    const mediaUploader = wp.media({
      title: __("Select or Upload an Image", "schema-package"),
      button: { text: __("Use this image", "schema-package") },
      multiple: false,
    });

    mediaUploader.on("select", () => {
      const attachment = mediaUploader.state().get("selection").first().toJSON();
      handleCustomFieldChange(schemaKey, "custom_image", attachment.url);
    });

    mediaUploader.open();
  };

  useEffect(() => {    
    handleMappedPropertiesValue(selectedMetaFields)
  },[selectedMetaFields])

  return (
    <>        
      <Divider horizontal style={{ marginTop: "30px" }} >{__("Mapping", "schema-package")}</Divider>
      <Grid columns={3} divided>
        <Grid.Row>
          <Grid.Column textAlign="center">
            <Label as="a" color="blue" ribbon>
              {__("Schema Properties", "schema-package")}
            </Label>
          </Grid.Column>
          <Grid.Column textAlign="center">
            <Label as="a" color="blue" ribbon>
              {__("Post Meta Fields", "schema-package")}
            </Label>
          </Grid.Column>
          <Grid.Column textAlign="center">
            <Label as="a" color="blue" ribbon>
              {__("Custom Meta Fields", "schema-package")}
            </Label>
          </Grid.Column>
        </Grid.Row>

        {mappedPropertiesKey.map((propertyKey) => {
          const schemaProperty = schemaProperties.find((p) => p.key === propertyKey);
          const selectedMeta = selectedMetaFields[propertyKey] || {};

          return (
            <Grid.Row key={propertyKey} style={{ paddingBottom: "0" }}>
              {/* First Column: Schema Property */}
              <Grid.Column>
                <Segment style={{ padding: "9px", paddingLeft: "14px", boxShadow: "none" }}>
                  <Header as="h5" style={{ margin: 0, fontWeight: "normal" }}>
                    {schemaProperty?.text}
                  </Header>
                </Segment>
              </Grid.Column>

              {/* Second Column: WordPress Meta Fields Dropdown */}
              <Grid.Column>
                <Dropdown
                  placeholder="Select Meta Field"
                  fluid
                  selection
                  options={wpMetaList}
                  value={selectedMeta.meta_field || ""}
                  onChange={(_, { value }) => handleMetaFieldChange(propertyKey, value)}
                />
              </Grid.Column>

              {/* Third Column: Custom Meta Fields */}
              <Grid.Column>
                {selectedMeta.meta_field ? (
                  selectedMeta.meta_field === "taxonomy_term" ? (
                    <Dropdown
                      placeholder="Select Taxonomy"
                      fluid
                      selection
                      options={taxonomyList}
                      value={selectedMeta.taxonomy || ""}
                      onChange={(_, { value }) => handleCustomFieldChange(propertyKey, "taxonomy", value)}
                    />
                  ) : selectedMeta.meta_field === "custom_text" ? (
                    <TextArea
                      placeholder="Enter custom text..."
                      style={{ width: "100%" }}
                      value={selectedMeta.custom_text || ""}
                      onChange={(e) => handleCustomFieldChange(propertyKey, "custom_text", e.target.value)}
                    />
                  ) : selectedMeta.meta_field === "custom_field" ? (
                    <Dropdown
                      placeholder="Select Custom Field"
                      fluid
                      search
                      selection
                      options={customFieldsList}
                      value={selectedMeta.custom_field || ""}
                      onSearchChange={(_, { searchQuery }) => setCustomFieldSearch(searchQuery)}
                      onChange={(_, { value }) => handleCustomFieldChange(propertyKey, "custom_field", value)}
                    />
                  ) : selectedMeta.meta_field === "advanced_custom_field" ? (
                    <Dropdown
                      placeholder="Select Advanced Custom Field"
                      fluid
                      search
                      selection
                      options={advancedCustomFieldsList}
                      value={selectedMeta.advanced_custom_field || ""}
                      onSearchChange={(_, { searchQuery }) => setAdvancedCustomFieldSearch(searchQuery)}
                      onChange={(_, { value }) => handleCustomFieldChange(propertyKey, "advanced_custom_field", value)}
                    />
                  ): selectedMeta.meta_field === "custom_image" ? (
                    <>
                      {selectedMeta.custom_image && <Image src={selectedMeta.custom_image} size="small" style={{paddingBottom:"4px"}} />}
                      <Button primary onClick={() => openMediaUploader(propertyKey)}>
                        {selectedMeta.custom_image ? __("Change Image", "schema-package") : __("Upload Image", "schema-package")}
                      </Button>
                    </>
                  ) : null
                ) : (
                  <div style={{ display: "none" }} />
                )}
              </Grid.Column>
            </Grid.Row>
          );
        })}
      </Grid>
    </>
  );
};

export default SchemaMapping;
