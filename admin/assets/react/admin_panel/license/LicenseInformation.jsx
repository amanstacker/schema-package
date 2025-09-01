import React, { useState } from "react";
import { Card, Button, Icon, Label, Modal, Message } from "semantic-ui-react";

export default function LicenseInformation({ licenseData, updateLicenseData }) {
  
  const { __ } = wp.i18n;
  
  
  const [status, setStatus] = useState(licenseData.license === 'valid' ? 'Active' : '' );    
  const [isMasked, setIsMasked] = useState(true);
  const [loading, setLoading] = useState(null);
  const [showModal, setShowModal] = useState(false);
  
  const handleApiRequest = async (edd_action) => {
    setLoading(edd_action);
    try {
      let url = smpg_local.rest_url + 'license-action';
      const response = await fetch(url, {
        method: "POST",
        headers: { 
          "Content-Type": "application/json", 
          'X-WP-Nonce': smpg_local.nonce,  
         },
        body: JSON.stringify({ license_key: licenseData.license_key, edd_action: edd_action })
      });      
      const result = await response.json();
      
      if (!response.ok) throw new Error(result.message || "Something went wrong");

      if (result.status == 't') {

        if(result.data.license == 'invalid'){
          setStatus("error");
          setMessage(result.data.message);
        }else{
          updateLicenseData(result.data);           
        }        
        
      } else {
        setStatus("error");
        setMessage(result.data.message);
      }
            
    } catch (error) {
      alert(error.message);
    }
    setLoading(null);
  };

  return (
    <>
      {/* License Status */}
      <Card fluid>
        <Card.Content>
          <Card.Header>{__('License Information', 'schema-package')}</Card.Header>
        </Card.Content>
        <Card.Content>
          <div className="ui two column grid">
            <div className="column" style={{ width: "40%" }}><strong>{__('License Key:', 'schema-package')}</strong></div>
            <div className="column" style={{ display: "flex", alignItems: "stretch", gap: "8px" }}>
            <span className="ui label" style={{ display: "flex", alignItems: "center", padding: "0 12px" }}>
              {isMasked ? "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" : licenseData.license_key}
            </span>
            <Button
              icon
              onClick={(e) => {
                e.preventDefault();
                setIsMasked(!isMasked);
              }}
              style={{ display: "flex", alignItems: "center" }} // Ensures vertical alignment
            >
              <Icon name={isMasked ? "eye slash" : "eye"} />
            </Button>
          </div>
          </div>
          <div className="ui two column grid">
            <div className="column" style={{ width: "40%" }}><strong>{__('Status:', 'schema-package')}</strong></div>
            <div className="column"><Label color={status === "Active" ? "green" : "red"}>{status}</Label></div>
          </div>
          <div className="ui two column grid">
            <div className="column" style={{ width: "40%" }}><strong>{__('Expiry Date:', 'schema-package')}</strong></div>
            <div className="column"><Label>{licenseData.expires}</Label></div>
          </div>
          <div className="ui two column grid">
            <div className="column" style={{ width: "40%" }}><strong>{__('Account Email:', 'schema-package')}</strong></div>
            <div className="column"><Label>{licenseData.customer_email}</Label></div>
          </div>
          <div className="ui two column grid">
            <div className="column" style={{ width: "40%" }}><strong>{__('Left Activation Limit:', 'schema-package')}</strong></div>
            <div className="column"><Label>{licenseData.activations_left}</Label></div>
          </div>
          
          <Message icon success>
          <Icon name="check circle" />
          <Message.Content>
            <Message.Header>{__('Your license key is active!', 'schema-package')}</Message.Header>
            {__('You are receiving updates and priority support.', 'schema-package')}            
          </Message.Content>
        </Message>
        </Card.Content>
      </Card>
      
      {/* Actions */}
      <div className="ui buttons" style={{ marginTop: "20px" }}>
        <Button color="red" icon labelPosition="left" onClick={(e) => { e.preventDefault(); setShowModal(true); }} >
          <Icon name="trash" /> {__('Deactivate License', 'schema-package')}
        </Button>        
        <Button color="blue" icon labelPosition="left" onClick={(e) => { e.preventDefault(); handleApiRequest("activate_license"); }} loading={loading === "activate_license"}>
          <Icon name="refresh" /> {__('Refresh License', 'schema-package')}
        </Button>
        <a target="_blank" href={`https://schemapackage.com/checkout/?edd_license_key=${licenseData.license_key}&download_id=${licenseData.payment_id}`} className="ui button green" color="blue" icon labelPosition="left">
          <Icon name="repeat" /> {__('Renew License', 'schema-package')}
        </a>
      </div>
      
      {/* Confirmation Modal */}
      <Modal open={showModal} size="small">
        <Modal.Header>{__('Confirm Deactivation', 'schema-package')}</Modal.Header>
        <Modal.Content>
          <p>{__('Are you sure you want to deactivate your license?', 'schema-package')}</p>
        </Modal.Content>
        <Modal.Actions>
          <Button onClick={(e) => { e.preventDefault(); setShowModal(false); }}>{__('Cancel', 'schema-package')}</Button>
          <Button color="red" onClick={(e) => { e.preventDefault(); handleApiRequest("deactivate_license"); setShowModal(false); }} loading={loading === "deactivate_license"}>
            <Icon name="trash" /> {__('Deactivate', 'schema-package')}
          </Button>
        </Modal.Actions>
      </Modal>
    </>
  );
}
