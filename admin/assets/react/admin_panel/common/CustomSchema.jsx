import React, { useEffect, useState } from "react";
import { Form, TextArea, Message } from "semantic-ui-react";

const jsonPlaceholder = `{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "Title of a News Article",
  "image": [
    "https://example.com/photos/1x1/photo.jpg"
  ],
  "datePublished": "2024-01-05T08:00:00+08:00",
  "dateModified": "2024-02-05T09:20:00+08:00",
  "author": [
    {
      "@type": "Person",
      "name": "Jane Doe",
      "url": "https://example.com/profile/janedoe123"
    },
    {
      "@type": "Person",
      "name": "John Doe",
      "url": "https://example.com/profile/johndoe123"
    }
  ]
}`;

const CustomSchema = ( { setCustomSchema, customSchemaValue } ) => {

  const [jsonValue, setJsonValue] = useState(customSchemaValue);
  const [error, setError] = useState("");

  const validateJson = () => {
    if (!jsonValue.trim()) {
      setError(""); // Clear error if input is empty
      return;
    }

    try {
      JSON.parse(jsonValue);
      setError(""); // Clear error if valid JSON
    } catch (e) {
      setError("Invalid JSON format. Please correct it."); // Show error message
    }
  };
  useEffect(() => {
    validateJson();
  },[]);
  useEffect(() => {
    setCustomSchema(jsonValue);
  },[jsonValue]);

  return (
    <Form style={{ marginTop: "20px" }}>
      <Form.Field>        
        <TextArea          
          placeholder={jsonPlaceholder}
          rows={10}
          style={{ paddingTop: "10px" }}
          value={jsonValue}
          onChange={(e) => setJsonValue(e.target.value)}
          onBlur={validateJson} // Validate on focus out
        />
      </Form.Field>
      {error && <Message negative>{error}</Message>} {/* Show error only if exists */}
    </Form>
  );
};

export default CustomSchema;
