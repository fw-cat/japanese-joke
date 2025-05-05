import apiClient from './config'

export interface DajareTheme {
  id: number
  theme: string
  created_at: string
}

export interface DajareSubmission {
  id: number
  theme_id: number
  content: string
  author_name?: string
  created_at: string
}

export const dajareService = {
  /**
   * Get a random dajare theme
   */
  getRandomTheme: async (): Promise<DajareTheme> => {
    const response = await apiClient.get('/dajare/theme/random')
    return response.data
  },

  /**
   * Get submissions for a specific theme
   */
  getSubmissions: async (themeId: number): Promise<DajareSubmission[]> => {
    const response = await apiClient.get(`/dajare/submissions/${themeId}`)
    return response.data
  },

  /**
   * Submit a new dajare
   */
  submitDajare: async (submission: { 
    theme_id: number, 
    content: string, 
    author_name?: string 
  }): Promise<DajareSubmission> => {
    const response = await apiClient.post('/dajare/submit', submission)
    return response.data
  }
}