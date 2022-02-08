import { useForm } from "@/use/form";

export function useFormFeedback() {
  return useForm([{ 
    name: 'name',
    placeholder: 'Имя',
    validator: 'name'
  }, { 
    name: 'phone',
    placeholder: 'Номер телефона',
    validator: 'phone'
  }])
}