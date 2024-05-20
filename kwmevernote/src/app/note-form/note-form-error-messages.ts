// src/app/note-form/note-form-error-messages.ts

export interface ErrorMessage{
  forControl: string;
forValidator: string;
text: string;
}

export const NoteFormErrorMessages: ErrorMessage[] = [
{
forControl: 'user_id',
forValidator: 'required',
text: 'User ID is required.'
},
{
forControl: 'title',
forValidator: 'required',
text: 'Title is required.'
},
{
forControl: 'content',
forValidator: 'required',
text: 'Content is required.'
},
{
forControl: 'rating',
forValidator: 'required',
text: 'Rating is required.'
}
];
