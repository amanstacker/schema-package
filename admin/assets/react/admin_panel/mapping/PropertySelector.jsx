import React from 'react';
import { Grid, Checkbox, Form } from 'semantic-ui-react';

const PropertySelector = ({ schemaProperties, mappedProperties, onSelectProperty }) => {
  return (
    <Grid>
      <Grid.Row>
        <Grid.Column width={16}>          
          <Form>
            {schemaProperties.map((property) => (
              <Form.Field key={property.key}>
                <Checkbox
                  label={property.text}
                  checked={mappedProperties?.includes(property.key)}
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