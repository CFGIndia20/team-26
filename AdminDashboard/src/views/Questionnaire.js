import React from "react";
import axios from "axios";
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
    Modal,
    ModalHeader,
    ModalBody,
    ModalFooter,
    Button,
    Label,
} from "reactstrap";

// core components
import Header from "components/Headers/Header.js";

import AdminFooter from "components/Footers/AdminFooter.js";

class Tables extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            questions: [
                {
                    id: "seuifnseg",
                    unit_id: "1",
                    unitName: "Cleanliness",
                    question: "RandomQuestion1",
                },
                {
                    id: "seuiw3tjieg",
                    unit_id: "1",
                    unitName: "Cleanliness",
                    question: "jiq3g3qwitonw",
                },
                {
                    id: "wejt",
                    unit_id: "1",
                    unitName: "Cleanliness",
                    question: "w4ion",
                },
            ],
            tempQuestionId: "",
            tempQuestion: "",
        };
    }

    componentDidMount() {
        //Fetch centers
        //Fetch units
        //Fetch non verified donors
        // this.setState({ filteredTrips: this.state.trips });
        axios.get("http://localhost:8000/api/question").then((res) => {
            // console.log(res.data.data);
            this.setState({ questions: res.data.data });
        });
    }

    onChangeHandler = async (event) => {
        console.log(event.target.name, event.target.value);
        this.setState({ [event.target.name]: event.target.value });
    };

    onSubmitRequestHandler = (e) => {
        let ques = this.state.questions.find((x) => x.id == e.target.name);
        console.log("QUES", ques);
        console.log(this.state.tempQuestion, ques.question_text);

        if (this.state.tempQuestion !== ques.question_text) {
            let data = {
                id: parseInt(this.state.tempQuestionId),
                question_text: this.state.tempQuestion,
            };
            console.log("Data", data);
            axios.post("http://localhost:8000/api/question/update", data).then((res) => {
                alert("Question updated");
                this.setState({
                    modal: false,
                    tempQuestionId: "",
                    tempQuestion: "",
                });
            });
        }
    };

    onModalClickHandler = (e) => {
        if (this.state.modal === true) {
            this.setState({
                modal: false,
                tempQuestionId: "",
                tempQuestion: "",
            });
        } else {
            console.log(e.target.name);
            let ques = this.state.questions.find((x) => x.id == e.target.name);
            console.log(ques);
            this.setState({
                modal: true,
                tempQuestionId: ques.id,
                tempQuestion: ques.question_text,
            });
        }
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
                                    <h3 className="mb-0">Modify Questionnaire</h3>
                                </CardHeader>
                                <CardBody>
                                    {/* <Form> */}
                                    <Row>
                                        <Col lg="12" md="12">
                                            <Table responsive borderless hover>
                                                <thead>
                                                    <tr>
                                                        <th>Update Question</th>
                                                        <th>Question</th>

                                                        <th>Question Id</th>
                                                        <th>Unit Id</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {this.state.questions.map((question) => (
                                                        <tr>
                                                            <td>
                                                                <Button
                                                                    name={question.id}
                                                                    size="sm"
                                                                    color="primary"
                                                                    onClick={this.onModalClickHandler}
                                                                >
                                                                    Update
                                                                </Button>
                                                            </td>
                                                            <td>{question.question_text}</td>

                                                            <td>{question.id}</td>
                                                            <td>{question.unit_id}</td>
                                                        </tr>
                                                    ))}
                                                </tbody>
                                            </Table>
                                        </Col>
                                    </Row>
                                    {/* </Form> */}
                                </CardBody>
                            </Card>
                        </div>
                    </Row>
                </Container>
                <Container fluid>
                    <Modal isOpen={this.state.modal} fade={false} toggle={this.toggle}>
                        <ModalHeader toggle={this.onModalClickHandler}>Verify Donors</ModalHeader>
                        <ModalBody>
                            <Table>
                                <tr>
                                    <td>Question Id</td>
                                    <td>{this.state.tempQuestionId}</td>
                                </tr>
                                <tr>
                                    <td>Question</td>
                                    <td>
                                        <Input
                                            type="text"
                                            name="tempQuestion"
                                            value={this.state.tempQuestion}
                                            onChange={this.onChangeHandler}
                                        />
                                    </td>
                                </tr>
                            </Table>
                        </ModalBody>
                        <ModalFooter>
                            <Button
                                color="primary"
                                name={this.state.tempQuestionId}
                                onClick={this.onSubmitRequestHandler}
                            >
                                Submit
                            </Button>{" "}
                            <Button color="secondary" onClick={this.onModalClickHandler}>
                                Cancel
                            </Button>
                        </ModalFooter>
                    </Modal>

                    <AdminFooter />
                </Container>
            </>
        );
    }
}

export default Tables;
