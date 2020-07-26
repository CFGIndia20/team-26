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
            modal: false,
            tempDonorId: "",
            tempDonorName: "",
            tempDonorphone_number: "",
            tempDonorFeedback: "",
            donors: [],
        };
    }

    componentDidMount() {
        //Fetch centers
        //Fetch units
        //Fetch contributions

        axios.get("http://localhost:8000/api/contribution/all").then((res) => {
            console.log(res.data.data);
            this.setState({ donors: res.data.data });
        });
    }

    onModalClickHandler = (e) => {
        if (this.state.modal === true) {
            this.setState({
                modal: false,
                tempDonorId: "",
                tempDonorName: "",
                tempDonorphone_number: "",
                tempDonorAmount: "",
                tempDonorDescription: "",
                tempDonorFeedback: "",
            });
        } else {
            let donor = this.state.donors.find((x) => x.id == e.target.name);
            console.log("DONOR", donor);
            this.setState({
                modal: true,
                tempDonorId: e.target.name,
                tempDonorName: donor.donor.user.name,
                tempDonorphone_number: donor.donor.user.phone_number,
                tempDonorAmount: donor.amount,
                tempDonorDescription: donor.description,
                tempDonorFeedback: donor.feedback,
            });
        }
    };

    onChangeHandler = async (event) => {
        await this.setState({ [event.target.name]: event.target.value });
        console.log(this.state);
    };

    onSubmitRequestHandler = (event) => {
        let contri = {
            admin_feedback: this.state.tempDonorFeedback,
        };
        axios
            .post("http://localhost:8000/api/contribution/" + this.state.tempDonorId + "/commit", contri)
            .then((res) => {
                alert("Feedback updated!!");
                this.onModalClickHandler();
            });
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
                                    <h3 className="mb-0">View Contributions</h3>
                                </CardHeader>
                                <CardBody>
                                    {/* <Form> */}
                                    <Row>
                                        <Col lg="12" md="12">
                                            <Table responsive borderless hover>
                                                <thead>
                                                    <tr>
                                                        <th>Add Feedback</th>
                                                        {/* <th>Donor ID</th> */}
                                                        <th>Donor Name</th>
                                                        <th>Phone Number </th>
                                                        <th>Description</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {this.state.donors.map((donor) => (
                                                        <tr>
                                                            <td>
                                                                <Button
                                                                    name={donor.id}
                                                                    size="sm"
                                                                    color="primary"
                                                                    onClick={this.onModalClickHandler}
                                                                >
                                                                    Update
                                                                </Button>
                                                            </td>
                                                            <td>{donor.donor.user.name}</td>
                                                            <td>{donor.donor.user.phone_number}</td>
                                                            <td>{donor.description}</td>
                                                            <td>{donor.amount}</td>
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
                                    <td>Name</td>
                                    <td>{this.state.tempDonorName}</td>
                                </tr>
                                <tr>
                                    <td>phone_number</td>
                                    <td>{this.state.tempDonorphone_number}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{this.state.tempDonorDescription}</td>
                                </tr>
                                <tr>
                                    <td>Amount</td>
                                    <td>{this.state.tempDonorAmount}</td>
                                </tr>
                                <tr>
                                    <td>Add Feedback</td>
                                    <td>
                                        <FormGroup row>
                                            <Col sm={10}>
                                                <Input
                                                    type="textarea"
                                                    name="tempDonorFeedback"
                                                    onChange={this.onChangeHandler}
                                                    value={this.state.tempDonorFeedback}
                                                />
                                            </Col>
                                        </FormGroup>
                                    </td>
                                </tr>
                            </Table>
                        </ModalBody>
                        <ModalFooter>
                            <Button color="primary" onClick={this.onSubmitRequestHandler}>
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
