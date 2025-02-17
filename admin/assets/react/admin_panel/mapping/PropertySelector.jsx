import React from 'react';
import { Grid, Checkbox, Label, Form } from 'semantic-ui-react';

// Example properties list
const schemaProperties = [
  { key: 'name', text: 'Name' },
  { key: 'url', text: 'URL' },
  { key: 'description', text: 'Description' },
];

const PropertySelector = ({ selectedProperties, onSelectProperty }) => {
  return (
    <Grid>
      <Grid.Row>
        <Grid.Column width={16}>          
          <Form>
            {schemaProperties.map((property) => (
              <Form.Field key={property.key}>
                <Checkbox
                  label={property.text}
                  checked={selectedProperties.includes(property.key)}
                  onChange={() => onSelectProperty(property.key)}
                />
              </Form.Field>
            ))}
          </Form>
        </Grid.Column>
      </Grid.Row>
    </Grid>
  );
};

export default PropertySelector;