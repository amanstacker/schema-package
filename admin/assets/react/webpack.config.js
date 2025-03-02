const isProduction = process.env.NODE_ENV === 'production';
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
var path = require('path');

module.exports = {   
   mode: isProduction ? 'production' : 'development',
   devtool: isProduction ? false : 'source-map',
   entry: {
       admin_panel: './admin_panel/index.jsx',
       individual_post: './individual/metabox.jsx'
   },
   output: {
       path: path.resolve(__dirname, 'dist'),
       filename: "[name].js"
   },   
   module: {
       rules: [
           {
            test: /\.(css)$/,
            use: [
                process.env.NODE_ENV === 'production' 
                  ? MiniCssExtractPlugin.loader 
                  : 'style-loader',  // Ensures styles are applied in development
                'css-loader'
              ] 
           },
           {
               test: /\.jsx?$/,
               exclude: /node_modules/,
               use:[
                {
                  loader: 'babel-loader',
                  options: {
                    presets: ["@babel/env", "@babel/react"],
                    plugins:  ["@babel/plugin-proposal-class-properties"],
                  }
                }
            ],
           }           
       ]
   },
   resolve: {
       extensions: ['.js', '.jsx']
   },
   plugins: [
       new MiniCssExtractPlugin({
           filename: "[name].css"                  
       })
   ]
}