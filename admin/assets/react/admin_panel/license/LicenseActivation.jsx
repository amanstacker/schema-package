import React, { useState } from "react";
import { Input, Button, Message, Icon, Segment, List } from "semantic-ui-react";

const LicenseActivation = ({ licenseData, updateLicenseData }) => {

  const {__} = wp.i18n;         

  const [licenseKey, setLicenseKey]     = useState("");
  const [status, setStatus]             = useState("");
  const [message, setMessage]           = useState("");
  const [loading, setLoading]           = useState(false);  

  const handleActivate = async (e) => {
    e.preventDefault();  
    if (!licenseKey) {
      setMessage("Please enter a license key.");
      setStatus("error");
      return;
    }
    
    setLoading(true);
    setMessage("");
    setStatus("");

    try {
      let url = smpg_local.rest_url + 'license-action';
      const response = await fetch( url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          'X-WP-Nonce': smpg_local.nonce,  
        },
        body: JSON.stringify({ license_key: licenseKey, edd_action: 'activate_license' })
      });

      const result = await response.json();
      
      if (result.status == 't') {

        if(result.data.license == 'invalid'){
          setStatus("error");
          setMessage(result.data.message);
        }else{
          setStatus("success");
          setMessage("License activated successfully!");
          updateLicenseData(result.data);
        }
        
      } else {
        setStatus("error");
        setMessage(result.data.message);
      }
    } catch (error) {
      setStatus("error");
      setMessage("Error activating license. Please try again.");
    }

    setLoading(false);
  };

  return (
    <div style={{textAlign:"center"}}>      
      <h2>{__('Activate Your License', 'schema-package') }</h2>
      <p>{__('Enter your license key to unlock premium features and updates.', 'schema-package') }</p>

      <Segment padded>
        <Input
          fluid
          icon="lock"
          iconPosition="left"
          placeholder={__('Enter License Key', 'schema-package') }
          value={licenseKey}
          onChange={(e) => setLicenseKey(e.target.value)}          
        />
        <Button
          color="green"
          fluid
          style={{ marginTop: "10px" }}
          onClick={handleActivate}
          loading={loading}          
        >
          {__('Activate License', 'schema-package') }
        </Button>
      </Segment>

      {message && (
        <Message
          style={{ marginTop: "15px" }}
          color={status === "success" ? "green" : "red"}
        >
          {message}
        </Message>
      )}

      <List divided relaxed style={{ marginTop: "20px" }}>
        <List.Item>
          <Icon name="check circle" color="green" /> {__('Unlock premium features', 'schema-package') }
        </List.Item>
        <List.Item>
          <Icon name="refresh" color="green" /> {__('Get automatic updates', 'schema-package') }
        </List.Item>
        <List.Item>
          <Icon name="life ring" color="green" /> {__('Access priority support', 'schema-package') }
        </List.Item>
      </List>

      <p style={{ marginTop: "15px" }}>
            {__('Need a license?', 'schema-package') } <a href="https://schemapackage.com/premium/#pricing" target="_blank" rel="noopener noreferrer">{__('Get One Here', 'schema-package') }</a> <br />
            {__('Having trouble?', 'schema-package') } <a href="https://schemapackage.com/contactus/" target="_blank" rel="noopener noreferrer">{__('Contact Support', 'schema-package') }</a>
      </p>    
    </div>
  );
};

export default LicenseActivation;
