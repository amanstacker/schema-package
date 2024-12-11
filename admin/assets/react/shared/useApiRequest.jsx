import * as React from "react";
import { useState, useEffect } from "react";

const useApiRequest = url => {

  const [data, setData]         = useState(null);
  const [isLoaded, setIsLoaded] = useState(false);
  const [error, setError]       = useState(null);

  useEffect(() => {

    const fetchData = async () => {
        
       await fetch(url, {
            headers: {                    
              'X-WP-Nonce': smpg_local.nonce,
            }
          })
          .then(res => res.json())
          .then(
            (response) => {              
             setIsLoaded(true);
             setData(response);
            },        
            (error) => {         
                setError(error);
            }
          );    
    };
    fetchData();
  }, [url]);

  return { error, isLoaded, data };
};

export default useApiRequest;