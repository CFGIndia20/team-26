import React, {useCallback} from 'react';
import axios from 'axios';
import Dropzone from 'react-dropzone'
import $ from 'jquery';

const URI_BASE = "https://cfgresource.cognitiveservices.azure.com/vision/v3.0/read/analyze";
const SUBSCRIPTION_KEY = "176fc4bca0f742278ca5c5f7cc65abc8";
let IMAGE_URI = "http://africau.edu/images/default/sample.pdf";

class OCR extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            "binary" : null,
        }
    }

    extractText(data) {
        if(data.status == "succeeded") {
            let resultString ="";
            let results = data?.analyzeResult?.readResults;
            for(let i = 0; i < results.length; i++ ){
                let lineArray = results[i].lines;
                for( let j =0; j<lineArray.length; j++){
                    resultString += lineArray[j].text + " ";
                }
            }
            console.log(resultString);
            console.log("BYE");
            return resultString;
        }else{
            console.log("Could Not extract Text");
        }

    }

    getData = async (formData) => {
        let response1 = await this.fetchData1(formData);
        if(response1 && response1.status === 202) {
            let operation_location= response1.headers["operation-location"];
            setTimeout( async () => {
                let response2 = await this.fetchData2(operation_location);
                 let text = this.extractText(response2.data);
                 $("#responseTextArea").val(text);
                //  this.fetchData2(operation_location).then((res) => {
                //          return this.extractText(res.data);
                // });
                }, 10000);

        }
    }

    fetchData2 = async (operation_location) =>{
        let config1 = {
            "headers": {
                'Content-Type': 'application/json' ,
                "Ocp-Apim-Subscription-Key": `${SUBSCRIPTION_KEY}`
            }
        };
        try {
            return await axios.get(operation_location, config1);
        } catch (e) {
            console.log(e.response);
            return e.response;
        }

    }

    fetchData1 = async (formData)=> {
        let data = formData;
        let config1 = {
            "headers": {
                'Content-Type': 'multipart/form-data' ,
                "Ocp-Apim-Subscription-Key": `${SUBSCRIPTION_KEY}`
            }
        };

        try {
            return await axios.post(URI_BASE, data, config1);
        } catch (e) {
            console.log(e.response);
            return e.response;
        }
    }

    onDropFunction(acceptedFiles) {
        acceptedFiles.forEach((file) => {
            const reader = new FileReader();
            reader.onload = async () => {
                // Do whatever you want with the file contents
                const binaryStr = reader.result
                IMAGE_URI = binaryStr;
                console.log(binaryStr);

                const formData = new FormData();
                formData.append('file',file);
                $("#responseTextArea").val("The text is going to be extracted within 10 seconds...");
                let res = await this.getData(formData);

            }
            reader.readAsArrayBuffer(file);

    })
    }


    render() {
        return (
            <div className="OCR-form " style={{padding: "100px"}}>

                <h3>Image to read:</h3>
                <Dropzone onDrop={acceptedFiles => this.onDropFunction(acceptedFiles)}>
                    {({getRootProps, getInputProps}) => (
                        <section>
                            <div {...getRootProps()}>
                                <input {...getInputProps()} />
                                <p>Drag 'n' drop some files here, or click to select files</p>
                            </div>
                        </section>
                    )}
                </Dropzone>
                <br/><br/>
                <div id="wrapper" style={{width:"1020px", display:"table"}}>
                    <div id="jsonOutput" style={{width:"600px", display:"table-cell"}}>
                        <h3>Extracted Text:</h3>
                        <br/><br/>
                        <textarea id="responseTextArea" className="UIInput" style={{width:"580px", height:"400px"}}/>
                    </div>

                </div>
            </div>
        );
    }
}

export default OCR;
