import React from "react";
import axios from "axios";
// reactstrap components
import {
    Card,
    CardHeader,
    Table,
    Container,
    Row,
    CardText,
    CardTitle,
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
            data: {
                number_of_donations: "",
                top_3_donation: [],
                avg_donation: "",
                top_3_frequent_donors: [],
                top_3_centre_max_num_of_donors: [],
            },
        };
    }

    componentDidMount() {
        axios.get("http://localhost:8000/api/report/insights").then((res) => {
            this.setState({ data: res.data.data[0] });
            console.log(res.data.data);
        });
    }

    onChangeHandler = async (event) => {
        await this.setState({ [event.target.name]: event.target.value });
        console.log(this.state);
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
                                    <h3 className="mb-0">Insights</h3>
                                </CardHeader>
                                <CardBody>
                                    <Row>
                                        <Col>
                                            <Card>
                                                <CardBody>
                                                    <CardTitle>Number of Donations</CardTitle>
                                                    <CardText>{this.state.data.number_of_donations}</CardText>
                                                </CardBody>
                                            </Card>
                                        </Col>

                                        <Col>
                                            <Card>
                                                <CardBody>
                                                    <CardTitle>Top 3 Donations</CardTitle>
                                                    {this.state.data.top_3_donation.map((donation) => (
                                                        <>
                                                            <CardText>Donor: {donation.name}</CardText>
                                                            <CardText>Amount: {donation.amt}</CardText>
                                                        </>
                                                    ))}
                                                </CardBody>
                                            </Card>
                                        </Col>

                                        <Col>
                                            <Card>
                                                <CardBody>
                                                    <CardTitle>Average Donation</CardTitle>
                                                    <CardText>{this.state.data.avg_donation}</CardText>
                                                </CardBody>
                                            </Card>
                                        </Col>

                                        <Col>
                                            <Card>
                                                <CardBody>
                                                    <CardTitle>Top 3 Frequent Donors</CardTitle>
                                                    {this.state.data.top_3_frequent_donors.map((donation) => (
                                                        <>
                                                            <CardText>Donor: {donation.name}</CardText>
                                                            <CardText>
                                                                Numer of donations: {donation.contri_count}
                                                            </CardText>
                                                        </>
                                                    ))}
                                                </CardBody>
                                            </Card>
                                        </Col>

                                        <Col>
                                            <Card>
                                                <CardBody>
                                                    <CardTitle>Top 3 Centres with max Donors</CardTitle>
                                                    {this.state.data.top_3_centre_max_num_of_donors.map(
                                                        (donation) => (
                                                            <>
                                                                <CardText>
                                                                    Number of Donors: {donation.max_donors}
                                                                </CardText>
                                                                <CardText>
                                                                    Centre Name: {donation.name}
                                                                </CardText>
                                                            </>
                                                        )
                                                    )}
                                                </CardBody>
                                            </Card>
                                        </Col>
                                    </Row>
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
