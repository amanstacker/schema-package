import React, { useState, useEffect } from 'react';
import { Grid, Label, Header, Segment, Dropdown, Divider, TextArea } from 'semantic-ui-react';

// Example taxonomy values
const taxonomyValues = [
  { key: "category", value: "category", text: "Category" },
  { key: "tag", value: "tag", text: "Tag" },
  { key: "custom_tax", value: "custom_tax", text: "Custom Taxonomy" },
];

// Example custom fields (for searchable selection)
const customFields = [
  { key: "custom_1", value: "custom_1", text: "Custom Field 1" },
  { key: "custom_2", value: "custom_2", text: "Custom Field 2" },
];

const SchemaMapping = ({ schemaProperties, mappedProperties }) => {

  const { __ } = wp.i18n;

  const [wpMetaList, setWpMetaList] = useState([]);  
  const [selectedMetaFields, setSelectedMetaFields] = useState({});

  // Handle change in WP Meta Field selection
  const handleMetaFieldChange = (schemaKey, value) => {
    setSelectedMetaFields((prev) => ({
      ...prev,
      [schemaKey]: value,
    }));
  };


  // Fetch data from API when the component mounts
  useEffect(() => {
    const fetchMetaFields = async () => {
      try {
        const url      = smpg_local.rest_url + "smpg-route/get-mapping-meta-list";
        const response = await fetch(url,{
          headers: {                    
            'X-WP-Nonce': smpg_local.nonce,
          }
        });
        const data     = await response.json();
        setWpMetaList(data);                
      } catch (error) {
        console.error("Error fetching meta fields:", error);
      }
    };

    fetchMetaFields();
  }, []);
  
  return (
    <>
    <Divider style={{ marginTop: '30px' }} />
      <Grid columns={3} divided>
        <Grid.Row>
          <Grid.Column textAlign="center">
            <Label as="a" color="blue" ribbon>
              {__('Schema Properties', 'schema-package')}
            </Label>
          </Grid.Column>
          <Grid.Column textAlign="center">
            <Label as="a" color="blue" ribbon>
              {__('Post Meta Fields', 'schema-package')}
            </Label>
          </Grid.Column>
          <Grid.Column textAlign="center">
            <Label as="a" color="blue" ribbon>
              {__('Custom Meta Fields', 'schema-package')}
            </Label>
          </Grid.Column>
        </Grid.Row>

        {mappedProperties.map((propertyKey) => {

          const schemaProperty = schemaProperties.find((p) => p.key === propertyKey);

          return (
            <Grid.Row key={propertyKey} style={{ paddingBottom: "0" }}>
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
                  onChange={(_, { value }) => handleMetaFieldChange(propertyKey, value)} // Fix here
                />
              </Grid.Column>

              {/* Third Column: Custom Meta Fields */}
              <Grid.Column>
                {selectedMetaFields[propertyKey] ? (
                  selectedMetaFields[propertyKey] === "taxonomy_term" ? (
                    <Dropdown placeholder="Select Taxonomy" fluid selection options={taxonomyValues} />
                  ) : selectedMetaFields[propertyKey] === "custom_text" ? (
                    <TextArea placeholder="Enter custom text..." style={{ width: "100%" }} />
                  ) : selectedMetaFields[propertyKey] === "custom_field" ? (
                    <Dropdown
                      placeholder="Select Custom Field"
                      fluid
                      search
                      selection
                      options={customFields}
                    />
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