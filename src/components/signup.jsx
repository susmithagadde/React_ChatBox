import React, { Component } from "react";
import { PostData } from "../postdata";
import { Redirect } from "react-router-dom";
import "./signup.css";

class Signup extends Component {
  constructor(props) {
    super(props);
    this.state = {
      redirect: false,
      file: [],
      imageUrl: null
    };
  }

  onChange = event => {
    /* var file = event.target.files;
    console.log(file); */
    const file = this.refs.uploadImg.files[0];
    console.log(file);
    const reader = new FileReader();
    console.log(reader.result);
    reader.onloadend = () => {
      this.setState({
        imageUrl: reader.result
      });
    };
    if (file) {
      reader.readAsDataURL(file);
      this.setState({
        imageUrl: reader.result
      });
    } else {
      this.setState({
        imageUrl: ""
      });
    }
    console.log(this.state.imageUrl);
    this.setState({ [event.target.name]: event.target.value });

    console.log(this.state);
  };

  onRegister = event => {
    const temp = this.state;
    var formData = new FormData();
    formData.append("name", temp.name);
    formData.append("email", temp.email);
    formData.append("password", temp.password);
    PostData(formData, "/register").then(result => {
      let responseJSON = result;
      console.log(responseJSON);
      if (responseJSON.status === "success") {
        sessionStorage.setItem("formData", responseJSON);
        this.setState({ redirect: true });
        // this.props.history.push(`/home`);
      }
    });

    event.preventDefault();
  };

  render() {
    if (this.state.redirect) {
      return <Redirect to={"/home"} />;
    }

    if (sessionStorage.getItem("formData")) {
      return <Redirect to={"/home"} />;
    }

    return (
      <div className="main">
        <div className="container  col-md-6">
          <form className="signup-form" onSubmit={this.onRegister}>
            <div className="form-group">
              <input
                type="text"
                className="form-control"
                name="name"
                placeholder="Enter Your name"
                onChange={this.onChange}
              />
            </div>
            <div className="form-group">
              <input
                type="email"
                className="form-control"
                name="email"
                placeholder="Enter your email"
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
            <div className="form-group">
              <input
                id="file-upload1"
                name="file"
                type="file"
                ref="uploadImg"
                onChange={this.onChange}
              />
            </div>
            <button type="submit" value="submit" className="btn btn-primary">
              Register
            </button>
          </form>

          <a href="/signin">Already have an Account?</a>
        </div>
      </div>
    );
  }
}

export default Signup;
