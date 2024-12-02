<?php

class Validator {
    protected $errors = []; // lagrer feilmeldinger

    /**
     * validerer form feltene basert på tilpasset validering og params
     * @param string $formfield felt fra form 
     * @param mixed $fieldvalue input fra felt
     * @param string $validationtype type input
     * @param array $params 
     * @return mixed returnerer renset input
     */
    public function validate($formfield, $fieldvalue, $validationtype, $params = []) {
        
        $fieldvalue = htmlspecialchars(strip_tags(trim($fieldvalue)));

        
        switch ($validationtype) {
            case 'email':
                $fieldvalue = filter_var($fieldvalue, FILTER_SANITIZE_EMAIL);
                if (!filter_var($fieldvalue, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$formfield][] = " <br> Ikke gyldig email adresse";
                }
                break;

            case 'phone':
                if (!preg_match('/^(\\+47|47)?[4|9]\\d{7}$/', $fieldvalue)) {
                    $this->errors[$formfield][] = " <br> Ugyldig format. Mobilnummeret må tilsvare norsk format, med 7 tall og starte på 4 eller 9, prøv igjen.";
                }
                break;

            case 'password':
                if (!(
                    strlen($fieldvalue) >= 9 &&
                    preg_match('/[A-Z]/', $fieldvalue) &&
                    preg_match('/^(?=(.*\\d.*\\d))[!@#$%^&*(),.?":{}|<>0-9a-zA-Z]*$/', $fieldvalue)
                )) {
                    $this->errors[$formfield][] = " <br> Ugyldig format. Passordet må inneholde minst 9 tegn, 2 tall, én stor bokstav, og ett spesialtegn, prøv igjen.";
                }
                break;

            case 'maxLength':
                if (!empty($params['length']) && strlen($fieldvalue) > $params['length']) {
                    $this->errors[$formfield][] = "$formfield kan ikke være lengre enn {$params['length']} tegn.";
                }
                break;
        }

        return $fieldvalue; // Returner renset data
    }

        /**
     * Printer feilmelding hvis funnet (true)
     * @return bool True hvis feil finnes, false hvis ikke
     */
    public function printErrors() {
        if (!empty($this->errors)) {
            foreach ($this->errors as $field => $messages) {
                foreach ($messages as $message) {
                    echo "<br> Feil i $field: $message";
                }
            }
            return true; 
        }
        return false; 
    }
}
?>