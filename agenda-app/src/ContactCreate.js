import React, { useState } from "react";
import api from "./api";

const ContactCreate = history => {
  const [state, setState] = useState({
    first_name: "",
    last_name: "",
    email: "",
    street: "",
    state: "",
    number: "",
    country: "",
    city: ""
  });
  // eslint-disable-next-line no-unused-vars
  const [error, setError] = useState(null);

  const handleSubmit = async e => {
    e.preventDefault();
    console.log(e.target);

    try {
      api
        .post("/contacts", {
          ...state,
          phones: [{ number: "6799932", area_code: 67 }]
        })
        .then(response => {
          if (response.status === 200) {
            window.location.href = "/";
          } else {
            setError({ status: response.status, message: response.message });
          }
        });
    } catch (e) {
      console.error(e.message);
      setError({ status: e.status, message: e.message });
    }
  };

  const onChange = e => {
    e.persist();
    setState(prevState => ({
      ...prevState,
      [e.target.name]: e.target.value
    }));
  };
  return (
    <div className="row">
      <form className="col s12" onSubmit={e => handleSubmit(e)}>
        <fieldset>
          <legend>Informações Pessoais</legend>
          <div className="row">
            <div className="input-field col m6">
              <label
                htmlFor="first_name"
                data-error="wrong"
                data-success="right"
              >
                Primeiro nome
              </label>
              <input
                type="text"
                required=""
                className="validate"
                name="first_name"
                value={state.first_name}
                onChange={e => onChange(e)}
              />
            </div>
            <div className="input-field col m6">
              <label
                htmlFor="last_name"
                data-error="wrong"
                data-success="right"
              >
                Sobrenome
              </label>
              <input
                type="text"
                required=""
                className="validate"
                name="last_name"
                value={state.second_name}
                onChange={e => onChange(e)}
              />
            </div>
          </div>
          <div className="row">
            <div className="input-field col s12 ">
              <label htmlFor="email" data-error="wrong" data-success="right">
                Email
              </label>
              <input
                type="text"
                className="validate"
                value={state.email}
                required=""
                name="email"
                onChange={e => onChange(e)}
              />
            </div>
          </div>
          <div className="row">
            <div className="input-field col s12">
              <label htmlFor="email" data-error="wrong" data-success="right">
                Data de Nascimento
              </label>
              <input
                type="text"
                className="validate"
                maxLength={10}
                value={state.birth}
                required=""
                name="birth"
                onChange={e => onChange(e)}
              />
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend>Endereço</legend>
          <div className="row">
            <div className="input-field col s12">
              <label htmlFor="street" data-error="wrong" data-success="right">
                Logradouro
              </label>
              <input
                type="text"
                className="validate"
                value={state.street}
                required=""
                name="street"
                onChange={e => onChange(e)}
              />
            </div>
          </div>
          <div className="row">
            <div className="input-field col s12">
              <label htmlFor="city" data-error="wrong" data-success="right">
                Cidade
              </label>
              <input
                type="text"
                className="validate"
                required=""
                name="city"
                value={state.city}
                onChange={e => onChange(e)}
              />
            </div>
          </div>
          <div className="row">
            <div className="input-field col s6">
              <label htmlFor="number" data-error="wrong" data-success="right">
                Número
              </label>
              <input
                type="text"
                className="validate"
                name="number"
                value={state.number}
                required=""
                onChange={e => onChange(e)}
              />
            </div>
            <div className="input-field col s12 m6">
              <label htmlFor="state" data-error="wrong" data-success="right">
                Estado
              </label>
              <input
                type="text"
                className="validate"
                value={state.state}
                required=""
                name="state"
                onChange={e => onChange(e)}
              />
            </div>
            <div className="input-field col s12">
              <label htmlFor="state" data-error="wrong" data-success="right">
                País
              </label>
              <input
                type="text"
                className="validate"
                value={state.country}
                required=""
                name="country"
                onChange={e => onChange(e)}
              />
            </div>
          </div>
          <div className="input-field col s12">
            <label htmlFor="state" data-error="wrong" data-success="right">
              CEP
            </label>
            <input
              type="text"
              className="validate"
              value={state.post_code}
              required=""
              name="post_code"
              onChange={e => onChange(e)}
            />
          </div>
        </fieldset>
        <fieldset>
          <legend>
            Telefones
            <span style={{ padding: "12px" }}>
              <button
                className="btn btn-primary button btn-small disabled green accent-3"
                id="add"
                disabled
              >
                <div>
                  <i className="material-icons">add</i>
                </div>
              </button>
            </span>
          </legend>
          {/* {phones.map((phone, key) => ( */}
          {/* <PhoneCreate key={key} /> */}
          <div className="row">
            <div className="input-field col s2 m4">
              <label htmlFor="area_code">DDD</label>
              <input
                type="text"
                required=""
                maxLength="2"
                name="area_code"
                value="12"
              />
            </div>
            <div className="input-field col s8 m8">
              <label
                htmlFor="phone_number"
                data-error="wrong"
                data-success="right"
              >
                Telefone
              </label>
              <input
                type="text"
                name="phone_number"
                required=""
                maxLength="16"
                value="993293993"
              />
            </div>
          </div>
          {/* <button
                  className="btn btn-danger button btn-small right red accent-3"
                  id="remove"
                  onClick={e => {
                    e.preventDefault();
                    let filtedPhones = phones.filter(
                      item => item.id !== phone.id
                    );
                    setPhones(filtedPhones);
                  }}
                >
                  <i className="material-icons">remove</i>
                </button> */}
          {/* </div> */}
          {/* ))} */}
        </fieldset>

        <div className="input-field col right">
          <button
            className="btn waves-effect waves-light blue accent-3"
            type="submit"
            name="action"
            onClick={e => handleSubmit(e)}
          >
            Enviar
          </button>
        </div>
      </form>
    </div>
  );
};

export default ContactCreate;
