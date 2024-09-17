import sys
import numpy as np
import cv2
from keras.models import load_model

# Load the trained model
model = load_model('alzheimers_model.h5')

# Define a function to predict the disease class given an input image
def predict_disease(image_path):
    # Load and preprocess the image
    img = cv2.imread(image_path)
    img = cv2.resize(img, (150, 150))  # Resize the image to match the input size of the model
    img_array = np.array(img)
    img_array = img_array.reshape(1, 150, 150, 3)  # Reshape the image array to match the model's input shape

    # Predict the class of the image
    prediction = model.predict(img_array)
    predicted_class_index = np.argmax(prediction)
    labels = ['MildDemented', 'ModerateDemented', 'NonDemented', 'VeryMildDemented']
    predicted_class = labels[predicted_class_index]
    
    return predicted_class

# Entry point of the script
if __name__ == "__main__":
    # Get the image path from command-line argument
    image_path = sys.argv[1]
    
    # Predict the disease class
    predicted_disease = predict_disease(image_path)
    print(predicted_disease)  # Output the predicted disease class without any additional characters
