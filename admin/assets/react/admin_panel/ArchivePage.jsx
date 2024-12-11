import React from 'react';

const ArchivePage = () => {
  const {__} = wp.i18n; 
  
  return (
    <div>{__('Archive pge', 'schema-package') }</div>
  )
}
export default ArchivePage;