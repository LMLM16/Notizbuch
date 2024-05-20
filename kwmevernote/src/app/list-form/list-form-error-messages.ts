// src/app/list-form/list-form-error-messages.ts

export interface ErrorMessage {
  forControl: string;
forValidator: string;
text: string;
}

export const ListFormErrorMessages: ErrorMessage[] = [
{
forControl: 'user_id',
forValidator: 'required',
text: 'User ID is required.'
},
{
forControl: 'name',
forValidator: 'required',
text: 'Name is required.'
},
{
forControl: 'is_public',
forValidator: 'required',
text: 'Public status is required.'
}
];
