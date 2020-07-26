import React from "react";

// reactstrap components
import {
  Card,
  CardHeader,
  Table,
  Container,
  Row,
  Col,
  FormGroup,
  Input,
  CardBody,
  Button,
  Label
} from "reactstrap";
// core components
import Header from "components/Headers/Header.js";

import AdminFooter from "components/Footers/AdminFooter.js";

import Speech from "react-speech";
import { restElement } from "@babel/types";

class Tables extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      questions: [
        {
          id: "safety",
          question: "How would rate our safety and hygiene service?",
          subquestions: ["", ""]
        },
        {
          id: "transport",
          question: "Please rate our Transportation facility.",
          subquestions: ["", ""]
        },
        {
          id: "food",
          question:
            "Please rate the cooking facilities and nutritious rations.",
          subquestions: ["", ""]
        },
        {
          id: "education",
          question: "Please rate the quality of our education.",
          subquestions: ["", ""]
        },
        {
          id: "recreation",
          question: "Please rate our recreational facilities.",
          subquestions: ["", ""]
        },
        {
          id: "counselling",
          question:
            "Please rate the quality of our counselling facilities(Children and Parents).",
          subquestions: ["", ""]
        }
      ],

      pid: "",
      response: {
        safety: 5,
        transport: 5,
        food: 5,
        education: 5,
        recreation: 5,
        counselling: 5
        
      }
    };
  }

  componentDidMount() {
    //Fetch centers
    //Fetch units
    //Fetch non verified donors
    // this.setState({ filteredTrips: this.state.trips });
  }

  onChangeHandler = async event => {
    //Copy response variable from state
    let res = this.state.response;

    res[event.target.name] = event.target.value;

    await this.setState({ response: res });
    console.log(this.state);
  };

  onSubmitRequestHandler = event => {
    console.log("hello");
  };

  render() {
    return (
      <>
        <Header />
        {/* Page content */}
        <Container className="mt--7" fluid>
          {/* Table */}
          <Row>
            <div className="col">
              <Card className="shadow">
                <CardHeader className="border-0">
                  <h3 className="mb-0">Questionnaire</h3>
                </CardHeader>
                <CardBody>
                  {/* <Form> */}

                  {this.state.questions.map(question => (
                    <Row>
                      <Col md="7">{question.question} </Col>
                      <Col md="1"><Button>🔊<Speech text={question.question} lang="hin-IND" /></Button></Col>
                      <Col md="4">
                        <Input type="select" name={question.id} id="rating" onChange={this.onChangeHandler}>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </Input>
                      </Col>
                    </Row>
                  ))}
                  <Row><Button>Submit</Button></Row>

                  {/* </Form> */}
                </CardBody>
              </Card>
            </div>
          </Row>
        </Container>
        <Container fluid>
          <AdminFooter />
        </Container>
      </>
    );
  }
}

export default Tables;
