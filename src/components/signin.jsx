import React, { Component } from "react";
import { PostData } from "../postdata";
import { Redirect } from "react-router-dom";
class SignIn extends Component {
  constructor(props) {
    super(props);
    this.state = {
      redirect: false,
      testy: []
    };
  }
  onChange = event => {
    this.setState({ [event.target.name]: [event.target.value] });
    console.log(this.state);
  };

  onLogin = event => {
    const temp = this.state;
    console.log("temp", temp);
    var formData = new FormData();
    formData.append("name", temp.username);
    formData.append("password", temp.password);
    PostData(formData, "/login").then(result => {
      let responseJSON = result;
      console.log(responseJSON);
      //console.log(responseJSON.status);
      if (responseJSON.status === "success") {
        var data12 = responseJSON.data;
        const data = [...this.state.testy, data12];
        this.setState({ testy: data });
        sessionStorage.setItem("formData", responseJSON);

        this.setState({ redirect: true });
        // this.props.history.push(`/home`);
      }
    });

    event.preventDefault();
  };

  render() {
    console.log(this.state.testy);
    if (this.state.redirect) {
      return (
        <Redirect
          to={{
            pathname: "/home",
            state: this.state.testy
          }}
        />
      );
      /* return <Redirect to={"/home"} />; */
    }

    if (sessionStorage.getItem("formData")) {
      return (
        <Redirect
          to={{
            pathname: "/home",
            state: this.state.testy
          }}
        />
      );
      /* return <Redirect to={"/home"} />; */
    }
    return (
      <div className="main">
        <div className="container  col-md-6">
          <form className="signin-form" onSubmit={this.onLogin}>
            <div className="form-group">
              <input
                type="text"
                className="form-control"
                name="username"
                placeholder="Enter Your name"
                onChange={this.onChange}
              />
            </div>
            <div className="form-group">
              <input
                type="password"
                className="form-control"
                name="password"
                placeholder="Enter your password"
                onChange={this.onChange}
              />
            </div>
            <button type="submit" value="submit" className="btn btn-primary">
              Login
            </button>
          </form>

          <a href="/">No Account?</a>
        </div>
      </div>
    );
  }
}

export default SignIn;
