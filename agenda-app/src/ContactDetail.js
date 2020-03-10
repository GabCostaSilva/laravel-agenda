import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import api from "./api";

let counter = 0;
const ContactDetail = () => {
  const { uuid } = useParams();
  const [contact, setContact] = useState("");
  // eslint-disable-next-line no-unused-vars
  const [error, setError] = useState({});

  useEffect(() => {
    async function loadContact() {
      api
        .get(`/contacts/${uuid}`)
        .then(response => {
          setContact(response.data.data.contact[0]);
        })
        .catch(e => {
          console.log(e);
        });
    }

    loadContact();
  }, [uuid]);

  const handleFirstName = e => {
    setContact({ ...contact, first_name: e.target.value });
  };
  const handleLastName = e => {
    setContact({ ...contact, last_name: e.target.value });
  };

  const handleEmail = e => {
    setContact({ ...contact, email: e.target.value });
  };
  const handleBirth = e => {
    setContact({ ...contact, birth: e.target.value });
  };

  const handleStreet = e => {
    setContact({ ...contact, street: e.target.value });
  };
  const handleState = e => {
    setContact({ ...contact, state: e.target.value });
  };
  const handleNumber = e => {
    setContact({ ...contact, number: e.target.value });
  };
  const handleCountry = e => {
    setContact({ ...contact, country: e.target.value });
  };
  const handlePostCode = e => {
    setContact({ ...contact, post_code: e.target.value });
  };

  const handleChange = (e, id) => {
    let temp = contact.phones.slice();
    console.log(contact.phones);
    temp[id] = e.target.value;

    const newobj = { ...contact, phones: temp };
    setContact(newobj);
  };

  const addPhone = e => {
    const newPhones = [
      ...contact.phones,
      { area_code: "", number: "", id: counter++ }
    ];

    setContact({ ...contact, phones: newPhones });
    console.log(contact.phones);
  };

  const handleSubmit = async e => {
    e.preventDefault();
    api
      .post(`/contacts/${uuid}`, contact)
      .then(response => {
        console.log(response);

        if (response.status === 200) document.location = "/";
      })
      .catch(err => console.log(err));

    console.log(contact);

    // document.location = "/";
  };

  return (
    <div className="container">
      <div className="row">
        <h3 className="header">
          {contact ? (
            contact.first_name + " " + contact.last_name
          ) : (
            <div>Carregando...</div>
          )}
        </h3>
      </div>
      {contact ? (
        <>
          <fieldset>
            <legend>Informações Pessoais</legend>
            <div className="row">
              <div className="col s12 m6">
                <label htmlFor="first_name">Primeiro Nome</label>
                <input
                  type="text"
                  value={contact.first_name}
                  name="first_name"
                  onChange={e => handleFirstName(e)}
                />
              </div>
              <div className="col s12 m6">
                <label htmlFor="last_name">Sobrenome</label>
                <input
                  type="text"
                  value={contact.last_name}
                  name="last_name"
                  onChange={e => handleLastName(e)}
                />
              </div>
            </div>
            <div className="row">
              <div className="col s12 m6">
                <label htmlFor="email">Email</label>
                <input
                  type="text"
                  value={contact.email}
                  name="email"
                  onChange={e => handleEmail(e)}
                />
              </div>
              <div className="col s12 m6">
                <label htmlFor="birth">Data de Nascimento</label>
                <input
                  type="text"
                  value={contact.birth}
                  name="birth"
                  onChange={e => handleBirth(e)}
                />
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>Endereço</legend>
            <div className="row">
              <div className="col s12 m6">
                <label htmlFor="street">Logradouro</label>
                <input
                  type="text"
                  value={contact.street}
                  name="street"
                  onChange={e => handleStreet(e)}
                />
              </div>
              <div className="col s12 m2">
                <label htmlFor="number">Número</label>
                <input
                  type="text"
                  value={contact.number}
                  name="number"
                  onChange={e => handleNumber(e)}
                />
              </div>
              <div className="col s12 m4">
                <label htmlFor="post_code">CEP</label>
                <input
                  type="text"
                  value={contact.post_code}
                  name="post_code"
                  onChange={e => handlePostCode(e)}
                />
              </div>
            </div>
            <div className="row">
              <div className="col s12 m6">
                <label htmlFor="state">Estado</label>
                <input
                  type="text"
                  value={contact.state}
                  name="state"
                  onChange={e => handleState(e)}
                />
              </div>
              <div className="col s12 m6">
                <label htmlFor="country">País</label>
                <input
                  type="text"
                  value={contact.country}
                  name="country"
                  onChange={e => handleCountry(e)}
                />
              </div>
            </div>
          </fieldset>

          <fieldset>
            <legend>
              Telefones
              <button
                className="disabled btn-floating btn-small green accent-2"
                style={{ marginLeft: "6px" }}
                onClick={e => addPhone(e)}
                value="add"
                disabled
              >
                <i className="material-icons">add</i>">
              </button>
            </legend>
            {/* {contact.phones.map((phone, key) => {
              let phoneId = phone.uuid ? phone.uuid : counter++;
              return ( */}
            <div className="row">
              <div className="col s12 m2 offset-s6">
                <label htmlFor="area_code">DDD</label>
                <input
                  type="text"
                  value={12}
                  name="area_code"
                  maxLength={2}
                  id="code"
                  // onChange={e => handleChange(e, key)}
                />
              </div>
              <div className="col s12 m6">
                <label htmlFor="number">Telefone</label>
                <input
                  type="text"
                  value={992342394}
                  id={12}
                  maxLength={13}
                  name="number"
                  // onChange={e => handleChange(e, key)}
                />
              </div>
              <div className="button-container">
                <button
                  className="btn-small btn red accent-2 disabled valign-wrapper right"
                  // onClick={e => {
                  //   if (phone.uuid) {
                  //     console.log(JSON.stringify(phone));
                  //     api
                  //       .post("/phones/" + phone.uuid)
                  //       .then(response => console.log(response))
                  //       .catch(e => console.error(e));
                  //   }
                  //   let filteredPhones = contact.phones.filter(
                  //     item => item.id !== phone.id || item.uuid !== phone.uuid
                  //   );
                  //   setContact({ ...contact, phones: filteredPhones });
                  // }}
                  value={123}
                >
                  <i className="material-icons">remove</i>
                </button>
              </div>
            </div>
            {/* ); */}
            {/* })} */}
          </fieldset>

          <div className="row">
            <div className="col right">
              <button
                className="btn-small btn light-blue accent-2 valign-wrapper right"
                onClick={e => handleSubmit(e)}
              >
                Salvar
              </button>
            </div>
          </div>
        </>
      ) : (
        <div>Carregando...</div>
      )}
    </div>
  );
};

export default ContactDetail;
