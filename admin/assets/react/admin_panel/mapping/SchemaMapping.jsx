import React from 'react';
import { Grid, Label, Header, Segment, Dropdown, Divider } from 'semantic-ui-react';

// Example data for dropdowns
const wpMetaFields = [
  { key: 'post_title', value: 'post_title', text: 'Post Title' },
  { key: 'post_content', value: 'post_content', text: 'Post Content' },
  { key: 'post_date', value: 'post_date', text: 'Post Date' },
];

const customFields = [
  { key: 'author_name', value: 'author_name', text: 'Author Name' },
  { key: 'publish_date', value: 'publish_date', text: 'Publish Date' },
];

const schemaProperties = [
  { key: 'name', text: 'Name' },
  { key: 'url', text: 'URL' },
  { key: 'description', text: 'Description' },
];

const SchemaMapping = ({ selectedProperties }) => {
  return (
    <>
    {/* Divider */}
    <Divider style={{ marginTop: '30px' }} />      
    <Grid columns={3} divided>
      {/* Column Headers */}
      <Grid.Row>
        <Grid.Column textAlign="center">
          <Label as="a" color="blue" ribbon>
            Schema Properties
          </Label>
        </Grid.Column>

        <Grid.Column textAlign="center">
          <Label as="a" color="blue" ribbon>
            Post Meta Fields
          </Label>
        </Grid.Column>

        <Grid.Column textAlign="center">
          <Label as="a" color="blue" ribbon>
            Custom Fields
          </Label>
        </Grid.Column>
      </Grid.Row>

      {/* Dynamically Display Mapping Rows */}
      {selectedProperties.map((property) => (
        <Grid.Row key={property}>          
        <Grid.Column>
        <Segment 
            style={{
            padding: "9px",
            paddingLeft: "14px",
            boxShadow:"none"            
            }}
        >
            <Header as="h5" style={{ margin: 0, fontWeight: "normal" }}>
            {schemaProperties.find((p) => p.key === property)?.text}
            </Header>
        </Segment>
        </Grid.Column>

          {/* Second Column: WordPress Meta Fields Dropdown */}
          <Grid.Column>
            <Dropdown
              placeholder="Select Meta Field"
              fluid
              selection
              options={wpMetaFields}
            />
          </Grid.Column>

          {/* Third Column: Custom Fields Dropdown */}
          <Grid.Column>
            <Dropdown
              placeholder="Select Custom Field"
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