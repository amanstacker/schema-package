import React, { useState, useEffect } from 'react';
import { Grid, Label, Header, Segment, Dropdown, Divider } from 'semantic-ui-react';

const customFields = [
  { key: 'author_name', value: 'author_name', text: 'Author Name' },
  { key: 'publish_date', value: 'publish_date', text: 'Publish Date' },
];

const SchemaMapping = ({ schemaProperties, mappedProperties }) => {

  const { __ } = wp.i18n;

  const [wpTextMetaFields, setWpTextMetaFields] = useState([]);
  const [wpImageMetaFields, setWpImageMetaFields]   = useState([]);


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
        setWpTextMetaFields(data.textmeta);        
        setWpImageMetaFields(data.imagemeta);        
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

        {mappedProperties.map((property) => (
          <Grid.Row key={property} style={{ paddingBottom: '0' }}>
            <Grid.Column>
              <Segment
                style={{
                  padding: '9px',
                  paddingLeft: '14px',
                  boxShadow: 'none',
                }}
              >
                <Header as="h5" style={{ margin: 0, fontWeight: 'normal' }}>
                  {schemaProperties.find((p) => p.key === property)?.text}
                </Header>
              </Segment>
            </Grid.Column>

            {/* Second Column: WordPress Meta Fields Dropdown with Optgroups */}
            <Grid.Column>
              <Dropdown
                placeholder={__('Select Meta Field', 'schema-package')}
                fluid
                selection
                options={wpTextMetaFields}
              />
            </Grid.Column>

            {/* Third Column: Custom Fields Dropdown */}
            <Grid.Column>
              <Dropdown
                placeholder={__('Select Custom Field', 'schema-package')}
                fluid
                selection
                options={customFields}
              />
            </Grid.Column>
          </Grid.Row>
        ))}
      </Grid>
    </>    
  );
};

export default SchemaMapping;