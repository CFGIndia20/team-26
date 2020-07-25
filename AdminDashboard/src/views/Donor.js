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
            tempDonorMobile: "",
            tempDonorEmail: "",
            tempStatus: "",
            tempDonorCentre: "",
            tempDonorUnit: "",
            donors: [
                {
                    id: "sduifnu4w4",
                    name: "Ashwin",
                    mobile: "993848294",
                    email: "goelashwin36@gmail.com",
                },
                {
                    id: "erihnentohn",
                    name: "Harsh",
                    mobile: "998438294",
                    email: "harsh@gmail.com",
                },
                {
                    id: "weonowngw",
                    name: "Anmol",
                    mobile: "98433849",
                    email: "anmol@gmail.com",
                },
            ],
            centers: [
                {
                    id: "1",
                    name: "Random",
                },
                {
                    id: "2",
                    name: "Random",
                },
                {
                    id: "3",
                    name: "Random",
                },
            ],
            units: [
                {
                    id: "1",
                    name: "Alfa",
                },
                {
                    id: "2",
                    name: "Beta",
                },
                {
                    id: "3",
                    name: "Gamma",
                },
            ],
            statuses: [
                {
                    "1": "In process",
                    "2": "Verified",
                    "3": "Pending",
                },
            ],
            tempId: "",
            tempStatus: "",
        };
    }

    componentDidMount() {
        //Fetch centers
        //Fetch units
        //Fetch non verified donors
        // this.setState({ filteredTrips: this.state.trips });
    }

    onModalClickHandler = (e) => {
        if (this.state.modal === true) {
            this.setState({
                modal: false,
                tempDonorId: "",
                tempDonorName: "",
                tempDonorMobile: "",
                tempDonorEmail: "",
                tempStatus: "",
                tempDonorCentre: "",
                tempDonorUnit: "",
            });
        } else {
            let donor = this.state.donors.find((x) => x.id === e.target.name);
            this.setState({
                modal: true,
                tempDonorId: e.target.name,
                tempDonorName: donor.name,
                tempDonorMobile: donor.mobile,
                tempDonorEmail: donor.email,
            });
        }
    };

    onChangeHandler = async (event) => {
        await this.setState({ [event.target.name]: event.target.value });
        console.log(this.state);
    };

    onSubmitRequestHandler = (event) => {
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
                                    <h3 className="mb-0">Verify Donors</h3>
                                </CardHeader>
                                <CardBody>
                                    {/* <Form> */}
                                    <Row>
                                        <Col lg="12" md="12">
                                            <Table responsive borderless hover>
                                                <thead>
                                                    <tr>
                                                        <th>Update Feedback</th>
                                                        {/* <th>Donor ID</th> */}
                                                        <th>Donor Name</th>
                                                        <th>Phone Number </th>
                                                        <th>Email</th>
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
                                                            {/* <td>{donor.id}</td> */}
                                                            <td>{donor.name}</td>
                                                            <td>{donor.mobile}</td>
                                                            <td>{donor.email}</td>
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
                                    <td>Email</td>
                                    <td>{this.state.tempDonorEmail}</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td>{this.state.tempDonorMobile}</td>
                                </tr>
                                <tr>
                                    <td>Add Feedback</td>
                                    <td>
                                        {" "}
                                        <FormGroup row>
                                            <Col sm={10}>
                                                <Input type="textarea" name="text" name="tempFeedback" onChange = {this.onChangeHandler}/>
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
