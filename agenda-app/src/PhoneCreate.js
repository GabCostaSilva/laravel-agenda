import React, { useState } from "react";

const PhoneCreate = key => {
  const [state, setState] = useState({
    number: "",
    area_code: "",
    id: ""
  });

  const onChange = e => {
    setState({ ...state, [e.target.name]: e.target.value });
  };

  return (
    <div className="row" key={key}>
      <div className="input-field col s4">
        <label htmlFor="area_code" data-error="wrong" data-success="right">
          DDD
        </label>
        <input
          type="text"
          required=""
          maxLength="2"
          name="area_code"
          value={state.area_code}
          onChange={e => onChange(e)}
        />
      </div>
      <div className="input-field col s8">
        <label htmlFor="number" data-error="wrong" data-success="right">
          Telefone
        </label>
        <input
          type="text"
          name="number"
          required=""
          maxLength="16"
          value={state.number}
          onChange={e => onChange(e)}
        />
      </div>
    </div>
  );
};

export default PhoneCreate;
