import React, { useState, useEffect } from "react";
import { Loader, Message } from "semantic-ui-react";
import LicenseActivation from './LicenseActivation'
import LicenseInformation from './LicenseInformation'

const LicensePage = () => {

    const {__} = wp.i18n;     
        
    const [licenseData, setLicenseData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    const updateLicenseData = (newData) => {
        setLicenseData(newData);
    };

    useEffect(() => {
        let url = smpg_local.rest_url + 'smpg-route/license-data';
        fetch(url,{
            headers: {
                'Accept': 'application/json', 
                'X-WP-Nonce': smpg_local.nonce,         
              }
        }) 
          .then((response) => {
            if (!response.ok) {
              throw new Error("Network response was not ok");
            }
            return response.json();
          })
          .then((data) => {
            setLicenseData(data);
            setLoading(false);
          })
          .catch((error) => {
            setError(error.message);
            setLoading(false);
          });
      }, []);

      if (loading) return <Loader active inline="centered" />;
      if (error) return <Message negative>{error}</Message>;
    return(                
        <>
        {licenseData.license === 'valid' ? <LicenseInformation licenseData={licenseData} updateLicenseData={updateLicenseData} /> : <LicenseActivation licenseData={licenseData} updateLicenseData={updateLicenseData} />}
        </>                     
  );
  
}
export default LicensePage;