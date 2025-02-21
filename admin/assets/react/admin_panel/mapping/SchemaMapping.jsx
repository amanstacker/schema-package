import React, { useState, useEffect } from "react";
import { Grid, Label, Header, Segment, Dropdown, Divider, TextArea, Button, Image } from "semantic-ui-react";

const SchemaMapping = ({ schemaProperties, mappedProperties }) => {
  const { __ } = wp.i18n;

  const [wpMetaList, setWpMetaList] = useState([]);
  const [customFieldsList, setCustomFieldsList] = useState([]);
  const [taxonomyList, setTaxonomyList] = useState([]);
  const [selectedMetaFields, setSelectedMetaFields] = useState({});
  const [customFieldSearch, setCustomFieldSearch] = useState("");

  useEffect(() => {
    const fetchMetaFields = async () => {
      try {
        const url = smpg_local.rest_url + "smpg-route/get-mapping-meta-list";
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
        const url = `${smpg_local.rest_url}smpg-route/get-custom-fields?search=${encodeURIComponent(customFieldSearch)}`;
        const response = await fetch(url, {
          headers: { "X-WP-Nonce": smpg_local.nonce },
        });
        const data = await response.json();

        const formattedFields = data.map((field) => ({
          key: field.id,
          value: field.value,
          text: field.label,
        }));

        setCustomFieldsList(formattedFields);
      } catch (error) {
        console.error("Error fetching custom fields:", error);
      }
    };

    fetchCustomFields();
  }, [customFieldSearch]);

  useEffect(() => {
    const fetchTaxonomyValues = async () => {
      try {
        const url = smpg_local.rest_url + "smpg-route/get-taxonomies";
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
      [schemaKey]: { wpMeta: value },
    }));
  };

  const handleCustomFieldChange = (schemaKey, type, value) => {
    setSelectedMetaFields((prev) => ({
      ...prev,
      [schemaKey]: {
        wpMeta: prev[schemaKey]?.wpMeta,
        customText: type === "customText" ? value : prev[schemaKey]?.customText || "",
        taxonomy: type === "taxonomy" ? value : prev[schemaKey]?.taxonomy || "",
        customField: type === "customField" ? value : prev[schemaKey]?.customField || "",
        customImage: type === "customImage" ? value : prev[schemaKey]?.customImage || "",
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
      handleCustomFieldChange(schemaKey, "customImage", attachment.url);
    });

    mediaUploader.open();
  };

  useEffect(() => {
    console.log(customFieldsList);
  },[customFieldsList])

  return (
    <>
      <Divider style={{ marginTop: "30px" }} />
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

        {mappedProperties.map((propertyKey) => {
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
                  value={selectedMeta.wpMeta || ""}
                  onChange={(_, { value }) => handleMetaFieldChange(propertyKey, value)}
                />
              </Grid.Column>

              {/* Third Column: Custom Meta Fields */}
              <Grid.Column>
                {selectedMeta.wpMeta ? (
                  selectedMeta.wpMeta === "taxonomy_term" ? (
                    <Dropdown
                      placeholder="Select Taxonomy"
                      fluid
                      selection
                      options={taxonomyList}
                      value={selectedMeta.taxonomy || ""}
                      onChange={(_, { value }) => handleCustomFieldChange(propertyKey, "taxonomy", value)}
                    />
                  ) : selectedMeta.wpMeta === "custom_text" ? (
                    <TextArea
                      placeholder="Enter custom text..."
                      style={{ width: "100%" }}
                      value={selectedMeta.customText || ""}
                      onChange={(e) => handleCustomFieldChange(propertyKey, "customText", e.target.value)}
                    />
                  ) : selectedMeta.wpMeta === "custom_field" ? (
                    <Dropdown
                      placeholder="Select Custom Field"
                      fluid
                      search
                      selection
                      options={customFieldsList}
                      value={selectedMeta.customField || ""}
                      onSearchChange={(_, { searchQuery }) => setCustomFieldSearch(searchQuery)}
                      onChange={(_, { value }) => handleCustomFieldChange(propertyKey, "customField", value)}
                    />
                  ) : selectedMeta.wpMeta === "custom_image" ? (
                    <>
                      {selectedMeta.customImage && <Image src={selectedMeta.customImage} size="small" />}
                      <Button primary onClick={() => openMediaUploader(propertyKey)}>
                        {selectedMeta.customImage ? __("Change Image", "schema-package") : __("Upload Image", "schema-package")}
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
