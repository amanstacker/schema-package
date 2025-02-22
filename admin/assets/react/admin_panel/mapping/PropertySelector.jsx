import React from 'react';
import { Grid, Checkbox, Form } from 'semantic-ui-react';

const PropertySelector = ({ schemaProperties, mappedPropertiesKey, onSelectProperty }) => {
  const splitIndex = schemaProperties.length > 10 ? Math.ceil(schemaProperties.length / 2) : schemaProperties.length;
  const firstColumn = schemaProperties.slice(0, splitIndex);
  const secondColumn = schemaProperties.slice(splitIndex);

  return (
    <Grid>
      <Grid.Row columns={schemaProperties.length > 10 ? 2 : 1}>
        <Grid.Column>
          <Form>
            {firstColumn.map((property) => (
              <Form.Field key={property.key}>
                <Checkbox
                  label={property.text}
                  checked={mappedPropertiesKey?.includes(property.key)}
                  onChange={() => onSelectProperty(property.key)}
                />
              </Form.Field>
            ))}
          </Form>
        </Grid.Column>

        {schemaProperties.length > 10 && (
          <Grid.Column>
            <Form>
              {secondColumn.map((property) => (
                <Form.Field key={property.key}>
                  <Checkbox
                    label={property.text}
                    checked={mappedPropertiesKey?.includes(property.key)}
                    onChange={() => onSelectProperty(property.key)}
                  />
                </Form.Field>
              ))}
            </Form>
          </Grid.Column>
        )}
      </Grid.Row>
    </Grid>
  );
};

export default PropertySelector;
