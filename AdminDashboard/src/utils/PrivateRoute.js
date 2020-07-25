import React from "react";
import { Route, Redirect } from "react-router-dom";
import { validateSession } from "./Common";
import { Spinner } from "reactstrap";
import { css } from "@emotion/core";
import BeatLoader from "react-spinners/BeatLoader";
import { readBuilderProgram } from "typescript";

const override = {
    display: 'block',
    margin: '5 auto !important',
    borderColor: 'red'
};

const center = {
    position: 'fixed',
    top: '50%',
    left: '50%'
  };

class PrivateRoute extends React.Component {
    constructor(props) {
        super(props);
        this.state = { authorized: null, loading: true };
    }

    componentDidMount() {
        // setState is called once the asynchronous call is resolved.
        validateSession().then((authorized) => this.setState({ authorized }));
    }

    render() {
        if (this.state.authorized === true) {
            const { component: Component, ...rest } = this.props;
            return <Route {...rest} render={(props) => <Component {...props} />} />;
        } else if (this.state.authorized === false) {
            return (
                <Redirect
                    to={{
                        pathname: "/auth/login",
                        state: { from: this.props.location },
                    }}
                />
            );
        }

        return (
            <div className="sweet-loading" style = {center}>
                <BeatLoader style={override} size={15} color={"#123abc"} loading={this.state.loading} />
            </div>
        );
    }
}

export default PrivateRoute;
