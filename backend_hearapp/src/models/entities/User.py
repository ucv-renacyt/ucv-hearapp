from flask_login import UserMixin

class User(UserMixin):
    def __init__(self, id, full_name, code, gender, civil_status, institutional_mail, personal_mail, campus_id, role_id, phone, password,state):
        self.id = id  
        self.full_name = full_name
        self.code = code
        self.gender = gender
        self.civil_status = civil_status
        self.institutional_mail = institutional_mail
        self.personal_mail = personal_mail
        self.campus_id = campus_id
        self.role_id = role_id
        self.phone = phone
        self.password = password
        self.state = state

    def check_password(self, password):
        return self.password == password