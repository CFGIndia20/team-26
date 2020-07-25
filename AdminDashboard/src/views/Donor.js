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
            tempDonorEmail: "",
            tempStatus: "",
            tempDonorCentre: "",
            tempDonorUnit: "",
            donors: [],
            centers: [],
            units: [],
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

        axios.get("http://localhost:8000/api/centre/all").then((res) => {
            this.setState({ centers: res.data.data });
        });

        axios.get("http://localhost:8000/api/unit/all").then((res) => {
            this.setState({ units: res.data.data });
        });

        axios.get("http://localhost:8000/api/donor/unverified").then((res) => {
            console.log("DATA:", res.data.data);
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
                tempDonorEmail: "",
                tempStatus: "",
                tempDonorCentre: "",
                tempDonorUnit: "",
            });
        } else {
            console.log(e.target.name)
            let donor = this.state.donors.find((x) => x.user.id == e.target.name);
            console.log(donor)
            this.setState({
                modal: true,
                tempDonorId: e.target.name,
                tempDonorName: donor.user.name,
                tempDonorphone_number: donor.user.phone_number,
                tempDonorEmail: donor.user.email,
            });
        }
    };

    onChangeHandler = async (event) => {
        await this.setState({ [event.target.name]: event.target.value });
        console.log(this.state);
    };

    onSubmitRequestHandler = (event) => {
        let update = {
            donor_id: parseInt(this.state.tempDonorId),
            is_verified: parseInt(this.state.tempStatus),
            donor_centre: parseInt(this.state.tempDonorCentre),
            donor_unit: parseInt(this.state.tempDonorUnit),
        };
        console.log(update);

        axios.post("http://localhost:8000/api/donor/updateVerificationStatus", update).then((res) => {
            console.log(update);
            alert("Status Updated");
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
                                    <h3 className="mb-0">Verify Donors</h3>
                                </CardHeader>
                                <CardBody>
                                    {/* <Form> */}
                                    <Row>
                                        <Col lg="12" md="12">
                                            <Table responsive borderless hover>
                                                <thead>
                                                    <tr>
                                                        <th>Verify Donor</th>
                                                        {/* <th>Donor ID</th> */}
                                                        <th>Donor Name</th>
                                                        <th>Phone Number </th>
                                                        <th>Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {this.state.donors.length > 0
                                                        ? this.state.donors.map((donor) => (
                                                              <tr>
                                                                  <td>
                                                                      <Button
                                                                          name={donor.user.id}
                                                                          size="sm"
                                                                          color="primary"
                                                                          onClick={this.onModalClickHandler}
                                                                      >
                                                                          Verify
                                                                      </Button>
                                                                  </td>
                                                                  {/* <td>{donor.id}</td> */}
                                                                  <td>{donor.user.name}</td>
                                                                  <td>{donor.user.phone_number}</td>
                                                                  <td>{donor.user.email}</td>
                                                              </tr>
                                                          ))
                                                        : null}
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
                                    <td>Id</td>
                                    <td>{this.state.tempDonorId}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{this.state.tempDonorName}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{this.state.tempDonorEmail}</td>
                                </tr>
                                <tr>
                                    <td>phone_number</td>
                                    <td>{this.state.tempDonorphone_number}</td>
                                </tr>
                                <tr>
                                    <td>Select Status</td>
                                    <td>
                                        {" "}
                                        <FormGroup row>
                                            <Label for="tempDonorCentre" sm={2}>
                                                Select
                                            </Label>
                                            <Col sm={10}>
                                                <Input
                                                    type="select"
                                                    onChange={this.onChangeHandler}
                                                    name="tempStatus"
                                                >
                                                    <option value="1">Verify</option>
                                                    <option value="2">Reject</option>
                                                </Input>
                                            </Col>
                                        </FormGroup>
                                    </td>
                                </tr>
                                {this.state.tempStatus === "1" ? (
                                    <>
                                        <tr>
                                            <td>Select Center</td>
                                            <td>
                                                {" "}
                                                <FormGroup row>
                                                    <Label for="tempDonorCentre" sm={2}>
                                                        Select
                                                    </Label>
                                                    <Col sm={10}>
                                                        <Input
                                                            type="select"
                                                            onChange={this.onChangeHandler}
                                                            name="tempDonorCentre"
                                                        >
                                                            {this.state.centers.length > 0
                                                                ? this.state.centers.map((centre) => (
                                                                      <option value={centre.id}>
                                                                          {centre.name}
                                                                      </option>
                                                                  ))
                                                                : null}
                                                        </Input>
                                                    </Col>
                                                </FormGroup>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Select Unit</td>
                                            <td>
                                                {" "}
                                                <FormGroup row>
                                                    <Label for="tempDonorUnit" sm={2}>
                                                        Select
                                                    </Label>
                                                    <Col sm={10}>
                                                        <Input
                                                            type="select"
                                                            onChange={this.onChangeHandler}
                                                            name="tempDonorUnit"
                                                        >
                                                            {this.state.units.length > 0
                                                                ? this.state.units.map((unit) => (
                                                                      <option value={unit.id}>
                                                                          {unit.name}
                                                                      </option>
                                                                  ))
                                                                : null}
                                                        </Input>
                                                    </Col>
                                                </FormGroup>
                                            </td>
                                        </tr>
                                    </>
                                ) : null}
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
