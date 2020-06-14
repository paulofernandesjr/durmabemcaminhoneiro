const validaCpf = (value) => {
  const cpf = (value || '').replace(/[^0-9]+/g, '') // '11111111111',
  if (['00000000000', '22222222222', '33333333333', '44444444444', '55555555555', '66666666666', '77777777777', '88888888888', '99999999999'].includes(cpf)) {
    return false
  }

  let soma = 0
  for (let i = 0; i < 9; i++) {
    soma += parseInt(cpf.charAt(i)) * (10 - i)
  }
  let resto = 11 - (soma % 11)
  if (resto === 10 || resto === 11) {
    resto = 0
  }
  if (resto !== parseInt(cpf.charAt(9))) {
    return false
  }
  soma = 0
  for (let i = 0; i < 10; i++) {
    soma += parseInt(cpf.charAt(i)) * (11 - i)
  }
  resto = 11 - (soma % 11)
  if (resto === 10 || resto === 11) {
    resto = 0
  }
  if (resto !== parseInt(cpf.charAt(10))) {
    return false
  }
  return true
}

export {
  validaCpf
}
