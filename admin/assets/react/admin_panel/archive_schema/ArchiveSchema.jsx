import React from 'react';
import './ArchiveSchema.css';

const ArchiveSchema = () => {
  const {__} = wp.i18n; 
  return(
    <>{__('Archive_schema', 'schema-package') }</>    
  )
}
export default ArchiveSchema;